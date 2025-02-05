<?php

use App\Models\User;
use App\Notifications\CommentMention;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\Notification;
use function Pest\Laravel\assertDatabaseHas;

it('detects and stores mentioned users', function () {
    $user = User::factory()->create();

    [$firstUser, $secondUser] = User::factory(2)
        ->state(new Sequence(
            ['username' => 'alex'],
            ['username' => 'tabby'],
        ))
        ->create();

    $comment = $user->comments()->create([
        'body' => "Mentioning @$firstUser->username and @$secondUser->username"
    ]);

    expect($comment->mentions)->toHaveCount(2)
        ->pluck('pivot.user_id')->toContain($firstUser->id, $secondUser->id);
});

it('removes users who are unmentioned', function () {
    $user = User::factory()->create();

    [$firstUser, $secondUser] = User::factory(2)
        ->state(new Sequence(
            ['username' => 'alex'],
            ['username' => 'tabby'],
        ))
        ->create();

    $comment = $user->comments()->create([
        'body' => "Mentioning @$firstUser->username and @$secondUser->username"
    ]);

    $comment->update([
        'body' => "Mentioning @$firstUser->username"
    ]);

    expect($comment->mentions)->toHaveCount(1)
        ->pluck('pivot.user_id')->toContain($firstUser->id)->not->toContain($secondUser->id);
});

it('sends a notification to mentioned users', function () {
    Notification::fake();

    $user = User::factory()->create();

    [$firstUser, $secondUser] = User::factory(2)
        ->state(new Sequence(
            ['username' => 'alex'],
            ['username' => 'tabby'],
        ))
        ->create();

    $comment = $user->comments()->create([
        'body' => "Mentioning @$firstUser->username and @$secondUser->username"
    ]);

    Notification::assertSentTo([$firstUser, $secondUser], CommentMention::class);
});

it('does not send a notification when modifying a comment', function () {
    Notification::fake();

    $user = User::factory()->create();

    $firstUser = User::factory()->create(['username' => 'alex']);

    $comment = $user->comments()->create([
        'body' => "Mentioning @$firstUser->username"
    ]);

    $comment->update([
        'body' => "Mentioning @$firstUser->username with a modified comment"
    ]);

    Notification::assertSentTimes(CommentMention::class, 1);
});
