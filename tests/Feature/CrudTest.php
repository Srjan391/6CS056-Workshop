<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CrudTest extends TestCase
{
    use RefreshDatabase;

    private function student(array $o = []): array
    {
        return array_merge([
            'name' => 'Ada Lovelace', 'email' => 'ada@example.com', 'phone' => '123',
            'address' => '1 Main St', 'date_of_birth' => '2000-01-02',
        ], $o);
    }

    private function course(array $o = []): array
    {
        return array_merge([
            'name' => 'Laravel', 'description' => 'Intro', 'duration' => 8,
            'fee' => '199.50', 'difficulty' => 'Medium', 'is_active' => '1',
        ], $o);
    }

    public function test_student_crud(): void
    {
        $this->get('/students')->assertOk()->assertSee('No students found.');
        $this->get('/students/create')->assertOk();

        $this->post('/students', $this->student())->assertRedirect('/students');
        $s = Student::firstOrFail();
        $this->get('/students')->assertSee('Ada Lovelace');
        $this->get("/students/{$s->id}")->assertOk()->assertSee('02 Jan 2000')->assertSee('Age:');
        $this->get("/students/{$s->id}/edit")->assertOk()->assertSee('value="2000-01-02"', false);

        $this->put("/students/{$s->id}", $this->student(['name' => 'Ada L']))->assertRedirect("/students/{$s->id}");
        $this->assertSame('Ada L', $s->fresh()->name);

        $this->delete("/students/{$s->id}")->assertRedirect('/students');
        $this->assertDatabaseCount('students', 0);
    }

    public function test_student_validation(): void
    {
        $this->post('/students', [])->assertSessionHasErrors(['name', 'email', 'phone']);
        $this->post('/students', $this->student());
        $this->post('/students', $this->student())->assertSessionHasErrors('email');
        $other = Student::create($this->student(['email' => 'b@example.com']));
        $this->put("/students/{$other->id}", $this->student(['email' => 'ada@example.com']))->assertSessionHasErrors('email');
        $this->put("/students/{$other->id}", $this->student(['email' => 'b@example.com']))->assertSessionDoesntHaveErrors();
    }

    public function test_course_crud(): void
    {
        $this->get('/courses')->assertOk()->assertSee('No courses found.');
        $this->post('/courses', $this->course())->assertRedirect('/courses');
        $c = Course::firstOrFail();
        $this->assertTrue($c->is_active);
        $this->get('/courses')->assertSee('Laravel');
        $this->get("/courses/{$c->id}")->assertOk();
        $this->get("/courses/{$c->id}/edit")->assertOk();

        $data = $this->course(['name' => 'PHP', 'difficulty' => 'Hard']);
        $data['is_active'] = '0';
        $this->put("/courses/{$c->id}", $data)->assertRedirect("/courses/{$c->id}");
        $c->refresh();
        $this->assertSame('PHP', $c->name);
        $this->assertFalse($c->is_active);

        $this->delete("/courses/{$c->id}")->assertRedirect('/courses');
        $this->assertDatabaseCount('courses', 0);
    }

    public function test_course_validation(): void
    {
        $this->post('/courses', [])->assertSessionHasErrors(['name', 'duration', 'fee', 'difficulty']);
        $this->post('/courses', $this->course(['difficulty' => 'Insane']))->assertSessionHasErrors('difficulty');
        $this->post('/courses', $this->course(['duration' => 'abc']))->assertSessionHasErrors('duration');
    }

    public function test_layout_navbar_footer_and_old_input(): void
    {
        $this->get('/students')->assertSee('Training Institute Management System')
            ->assertSee(route('courses.index'), false)->assertSee('css/app.css', false);

        $this->from('/students/create')->post('/students', $this->student(['phone' => '']))
            ->assertRedirect('/students/create');
        $this->get('/students/create')->assertSee('value="Ada Lovelace"', false);

        $this->post('/students', $this->student());
        $this->get('/students')->assertSee('alert-success', false);
        $this->get('/students')->assertDontSee('alert-success', false);
    }

    public function test_missing_records_404(): void
    {
        $this->get('/students/999')->assertNotFound();
        $this->get('/courses/999')->assertNotFound();
    }
}
