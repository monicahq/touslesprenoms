<?php

namespace App\Jobs;

use App\Models\Organization;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class PopulateAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Organization $organization)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->addRoles();
        $this->addLevels();
    }

    private function addRoles(): void
    {
        $roles = [
            trans_key('Software Engineer'),
            trans_key('Quality Assurance Engineer'),
            trans_key('Project Manager'),
            trans_key('Product Manager'),
            trans_key('UI/UX Designer'),
            trans_key('Data Analyst/Scientist'),
            trans_key('DevOps Engineer'),
            trans_key('Technical Support Engineer'),
            trans_key('Scrum Master'),
            trans_key('Sales/Account Manager'),
            trans_key('Technical Writer'),
            trans_key('System Administrator'),
            trans_key('Chief Executive Officer'),
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'organization_id' => $this->organization->id,
                'label' => null,
                'label_translation_key' => $role,
                'created_at' => now(),
            ]);
        }
    }

    private function addLevels(): void
    {
        $levels = [
            trans_key('Junior'),
            trans_key('Intermediate'),
            trans_key('Senior'),
            trans_key('Staff'),
        ];

        foreach ($levels as $level) {
            DB::table('levels')->insert([
                'organization_id' => $this->organization->id,
                'label' => null,
                'label_translation_key' => $level,
                'created_at' => now(),
            ]);
        }
    }
}
