<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            AccessSeeder::class,
            CountriesSeeder::class,
            CompetitionSeeder::class,
            AccommodationGuestSeeder::class,
            AccommodationPaymentSeeder::class,
            AccommodationSlotSeeder::class,
            CompetitionParticipantSeeder::class,
            CompetitionPaymentSeeder::class,
            CompetitionSlotSeeder::class,
            CompetitionSummariesSeeder::class,
            CompetitionTeamSeeder::class,
            EnvironmentSeeder::class,
            FlightRegistrationSeeder::class,
            FoodCouponSeeder::class,
            MerchandiseOrderSeeder::class,
            MerchandiseTransactionSeeder::class,
            ParticipantRankSeeder::class,
            PaymentProviderSeeder::class,
            PickUpScheduleSeeder::class,
            SideAchievementSeeder::class,
            SponsorSeeder::class,
        ]);
    }
}
