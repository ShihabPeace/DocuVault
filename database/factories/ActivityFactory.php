<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Activity;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    protected $model = Activity::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $indicolors = [
    "bg-blue-500", "bg-green-500", "bg-yellow-400", "bg-gray-400",
    "bg-blue-500", "bg-green-500", "bg-yellow-400", "bg-blue-500",
    "bg-green-500", "bg-red-500", "bg-orange-400", "bg-purple-500",
    "bg-green-600"
];

$roles = [
    "Finance", "Legal", "HR", "Finance",
    "Operations", "Legal", "Manager", "Finance",
    "HR", "System", "Operations", "Legal",
    "Manager"
];

$contents = [
    "Invoice – ABC Ltd uploaded",
    "Contract – XYZ Corp approved",
    "Employee record metadata updated",
    "Old invoice archived",
    "Purchase order scanned",
    "Policy document approved",
    "Contract pending review",
    "Invoice – DEF Ltd uploaded",
    "HR form approved",
    "Document deleted by admin",
    "Invoice awaiting upload",
    "Contract commented by legal team",
    "Document workflow completed"
];

        return [
            'indicolor' => $this->faker->randomElement($indicolors),
            'content' => $this->faker->randomElement($contents),
            'link' => '/documents/' . $this->faker->unique()->numberBetween(1, 100),
            'user' => $this->faker->name(),
            'role' => $this->faker->randomElement($roles),
            'checked' => $this->faker->boolean(),
        ];
    }
}
