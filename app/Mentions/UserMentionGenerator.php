<?php

namespace App\Mentions;

use App\Models\User;
use League\CommonMark\Extension\Mention\Generator\MentionGeneratorInterface;
use League\CommonMark\Extension\Mention\Mention;
use League\CommonMark\Node\Inline\AbstractInline;

class UserMentionGenerator implements MentionGeneratorInterface
{
    public function generateMention(Mention $mention): ?AbstractInline
    {
        $user = User::where('username', $mention->getIdentifier())->first();

        if (!$user) {
            return null;
        }

        $mention->setUrl(route('profile.show', $user));

        return $mention;
    }
}
