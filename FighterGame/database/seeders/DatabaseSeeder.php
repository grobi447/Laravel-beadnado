<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Character;
use App\Models\Place;
use App\Models\Contest;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User table
        $users = collect();
        $usersCount = rand(10, 20);

        $users->push(User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@fighter.com',
            'password' => 'admin',
            'admin' => true,
        ]));

        for ($i = 1; $i < $usersCount; $i++) {
            $users->push(User::factory()->create([
                'name' => "User{$i}",
                'email' => "user{$i}@fighter.com",
                'password' => "user{$i}",
            ]));
        }

        //Character table
        $characters = collect();
        $charactersCount = rand(20, 30);

        $characters->push(Character::factory()->create([
            'name' => 'AdminCharacter',
            'user_id' => $users->first()->id,
            'defence' => 10,
            'strength' => 10,
            'accuracy' => 10,
            'magic' => 10,
            'enemy' => true,
        ]));

        for ($i = 1; $i < $charactersCount; $i++) {
            $rand = $users->random();
            $character = Character::factory()->make();
            $character -> user()-> associate($rand);
            $character->enemy = $rand->admin ? fake()->boolean(50) : false;
            $character->save();
            $characters->push($character);
        }

        //Place table
        $places = collect();
        $placesCount = rand(5, 10);
        for ($i = 0; $i < $placesCount; $i++) {
            $place = Place::factory()->make();
            $place->save();
            $places->push($place);
        }

        //Contest table
        $contests = collect();
        $contestsCount = rand(20, 30);
        for ($i = 0; $i < $contestsCount; $i++) {
            $contest = Contest::factory()->make();
            $randHero = $characters->where('enemy', false)->random();
            $randEnemy = $characters->where('enemy', true)->random();
            $contest->user()->associate($randHero->user);
            $contest->place()->associate($places->random());
            $history =[];
            for ($j = 0; $j < rand(2,4); $j++) {
                $damage = rand(1, 5);
                $attackType = fake()->randomElement(['melee', 'ranged', 'magic']);
                if($j % 2 == 0){
                    $history[] = [
                        'character_name' => $randHero->name,
                        'action' => $attackType,
                        'damage' => $damage
                    ];
                }
                else{
                    $history[] = [
                        'character_name' => $randEnemy->name,
                        'action' => $attackType,
                        'damage' => $damage
                    ];
                }
            }
            $historyJson = json_encode($history);
            $contest->history = $historyJson;
            $contest->save();
            $contests->push($contest);

            //pivot table
            $winner_hp = rand(1, 20);
            $loser_hp = 0;
            if($contest->win){
                $contest->character()->attach($randHero, ['hero_hp' => $winner_hp, 'enemy_hp' => $loser_hp]);
                $contest->character()->attach($randEnemy, ['hero_hp' => $loser_hp, 'enemy_hp' => $winner_hp]);
            }
            else{
                $contest->character()->attach($randHero, ['hero_hp' => $loser_hp, 'enemy_hp' => $winner_hp]);
                $contest->character()->attach($randEnemy, ['hero_hp' => $winner_hp, 'enemy_hp' => $loser_hp]);
            }

        }
    }
}
