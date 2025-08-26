<?php

            namespace Database\Seeders;

            use App\Models\Project;
            use App\Models\User;
            use Illuminate\Database\Seeder;

            class ProjectSeeder extends Seeder
            {
                /**
                 * Run the database seeds.
                 */
                public function run(): void
                {
                    // Get users to assign projects to
                    $users = User::all();

                    if ($users->isEmpty()) {
                        $this->command->error('No users found. Please run UserSeeder first.');
                        return;
                    }

                    // Sample projects data
                    $projects = [
                        [
                            'name' => 'E-commerce Platform',
                            'description' => 'Build a new online shopping platform with customer accounts, product catalog, and payment processing.'
                        ],
                        [
                            'name' => 'Mobile App Development',
                            'description' => 'Create a cross-platform mobile application for both iOS and Android using Flutter.'
                        ],
                        [
                            'name' => 'Website Redesign',
                            'description' => 'Update the company website with modern design, improved user experience, and responsive layout.'
                        ],
                        [
                            'name' => 'CRM Integration',
                            'description' => 'Integrate our systems with Salesforce CRM to streamline customer data management.'
                        ],
                        [
                            'name' => 'Data Analytics Dashboard',
                            'description' => 'Develop an interactive dashboard to visualize key business metrics and performance indicators.'
                        ],
                    ];

                    // Create projects and assign to users
                    foreach ($projects as $projectData) {
                        Project::create([
                            'name' => $projectData['name'],
                            'description' => $projectData['description'],
                            'owner_id' => $users->random()->id,
                        ]);
                    }

                    $this->command->info('Created ' . count($projects) . ' sample projects!');
                }
            }
