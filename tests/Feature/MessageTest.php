<?php

namespace Tests\Feature;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    public function test_message_can_be_posted(): void
    {
        $response = $this->post('/mensagens', [
            'author' => 'João',
            'body' => 'Felicidades aos noivos!',
        ]);

        $response->assertRedirect('/mensagens');

        $this->assertDatabaseHas('messages', [
            'author' => 'João',
            'body' => 'Felicidades aos noivos!',
            'is_approved' => true,
        ]);
    }

    public function test_message_validation(): void
    {
        $response = $this->post('/mensagens', [
            'author' => '',
            'body' => '',
        ]);

        $response->assertSessionHasErrors(['author', 'body']);
        $this->assertSame(0, Message::query()->count());
    }

    public function test_messages_index_renders_approved_messages(): void
    {
        Message::factory()->create(['author' => 'Aprovada', 'body' => 'Texto aprovado', 'is_approved' => true]);
        Message::factory()->create(['author' => 'Pendente', 'body' => 'Texto pendente', 'is_approved' => false]);

        $response = $this->get('/mensagens');

        $response->assertOk();
        $response->assertSeeText('Aprovada');
        $response->assertDontSeeText('Pendente');
    }
}
