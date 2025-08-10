<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use App\Jobs\SendAdminVerificationEmail;
use App\Models\User;

class SendDailyAdminVerificationEmailsBatch extends Command
{
    protected $signature = 'emails:send-daily-admin-verifications';

    protected $description = 'Send daily batch of admin verification emails';

    public function handle()
    {
        // Fetch users who are not verified and flagged as pending email
        $users = User::whereNull('email_verified_at')
            ->where('pending_verification_email', true)
            ->get();

        if ($users->isEmpty()) {
            $this->info('No pending verification emails to send.');
            return 0;
        }

        // Map users to individual jobs
        $jobs = $users->map(fn ($user) => new SendAdminVerificationEmail($user))->toArray();

        // Dispatch batch
        Bus::batch($jobs)
            ->then(function () {
                // Mark users as no longer pending so they don’t get emails repeatedly
                User::whereNull('email_verified_at')
                    ->where('pending_verification_email', true)
                    ->update(['pending_verification_email' => false]);
            })
            ->catch(function () {
                $this->error('Batch failed!');
            })
            ->finally(function () {
                $this->info('Verification email batch finished.');
            })
            ->dispatch();

        $this->info('Batch dispatched for ' . count($jobs) . ' verification emails.');

        return 0;
    }
}
