<?php

namespace Database\Seeders;

use App\Models\Adoption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdoptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adoptions = [
            //1
            [
                'petname' => 'Clara',
                'status' => 'available',
                'description' => 'Clara is incredibly friendly, is great with kids and loves cuddles and belly rubs. She’s also very smart and will never leave your side. She also love to eat bacon and burger steak and drink milk a lot. Clara’s looking for a family who doesn’t have any other animals. Are you interested?',
                'animaltype' => 'cat',
                'estbirthday' => 'May 3, 2022',
                'color' => 'ash',
                'sex' => 'female',
                'imgsrc' => 'https://images.unsplash.com/photo-1602832309326-e1bd02f48a99?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8c3RyYXklMjBjYXR8ZW58MHx8MHx8&auto=format&fit=crop&w=600&q=60',
            ],
            //2
            [
                'petname' => 'Sparkles',
                'status' => 'available',
                'description' => 'Want to add some sparkle to your life? Sparkles was found by PETA in a public cemetery, where she was looking for food in the trash all by herself. She is very energetic, healthy, happy, playful and sparkly! She’s looking for a home where she can stay securely indoors where it’s safe.!',
                'animaltype' => 'dog',
                'estbirthday' => 'April 26, 2022',
                'color' => 'white',
                'sex' => 'male',
                'imgsrc' => 'https://images.unsplash.com/photo-1565353919366-554312dd0e86?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8OXx8c3RyYXklMjBkb2d8ZW58MHx8MHx8&auto=format&fit=crop&w=600&q=60',
            ],
            //3
            [
                'petname' => 'Aldo',
                'status' => 'available',
                'description' => 'Aldo has a great personality. He loves going for long walks in the park, around the block, or wherever else you’re up for taking him. He also enjoys cuddling and playing fetch and tug-of-war. He was found by a volunteer on the streets, alone, thin, and scared. He loves other dogs and doesn’t mind confident cats.',
                'animaltype' => 'dog',
                'estbirthday' => 'January 16, 2022',
                'color' => 'black, white',
                'sex' => 'male',
                'imgsrc' => 'https://images.unsplash.com/photo-1512728881812-4690c2953d4f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8NzJ8fHN0cmF5JTIwZG9nfGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=600&q=60',
            ],
            //4
            [
                'petname' => 'Garfield',
                'status' => 'available',
                'description' => 'Garfield is an independent, easy-to-please, and mellow senior cat. But the first few years of her life were anything but easy—her owner made use of PETA Asia’s KLIP program but never picked her up. PETA found her a new home, but her new owner decided to violate PETA’s adoption agreemen.',
                'animaltype' => 'cat',
                'estbirthday' => 'March 17, 2022',
                'color' => 'ginger',
                'sex' => 'male',
                'imgsrc' => 'https://images.unsplash.com/photo-1611492455689-30bc5be06445?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTl8fHN0cmF5JTIwY2F0fGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=600&q=60',
            ],
            //5
            [
                'petname' => 'Sofia',
                'status' => 'available',
                'description' => 'Sofia became lost, but PETA sent out a search party who found her, after three days of looking, and brought her back to the office. All she wants in life is a soft bed and a full food bowl—and of course, a loving family who will keep her indoors. Would you like to help ensure that Sofia has a happier life from now on?',
                'animaltype' => 'cat',
                'estbirthday' => 'June 3, 2022',
                'color' => 'dark gray, striped white',
                'sex' => 'female',
                'imgsrc' => 'https://images.unsplash.com/photo-1617167152423-61130d40b0fa?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80',
            ],
            //6
            [
                'petname' => 'Bruno',
                'status' => 'available',
                'description' => 'Bruno is a playful furbaby and loves eating vegetable. He loves going to the beach and play all day. He was abondoned by his owner and lives in the street for weeks. Our team found him and decided to take him in the center. He is looking for a new home that will make him feel not alone anymore.',
                'animaltype' => 'dog',
                'estbirthday' => 'May 14, 2022',
                'color' => 'brown',
                'sex' => 'male',
                'imgsrc' => 'https://images.unsplash.com/photo-1629555256341-09e5e9871647?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Nnx8c3RyYXklMjBkb2d8ZW58MHx8MHx8&auto=format&fit=crop&w=600&q=60',
            ]
        ];
        
        foreach ($adoptions as $key => $value) {
            Adoption::create($value);
        }
    }
}
