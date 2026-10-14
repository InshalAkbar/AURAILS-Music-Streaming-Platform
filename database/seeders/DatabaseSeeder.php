<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Music;
use App\Models\Video;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ============================================
        // 1. ADMIN & USERS
        // ============================================
        User::create([
            'user_name'           => 'Admin',
            'user_email'          => 'admin@gmail.com',
            'user_password'       => Hash::make('admin123'),
            'user_address'        => 'Admin Office',
            'user_phone'          => '1234567890',
            'user_role'           => 'admin',
            'user_remember_token' => Str::random(10),
        ]);

        $user = User::create([
            'user_name'           => 'Test User',
            'user_email'          => 'user@gmail.com',
            'user_password'       => Hash::make('user123'),
            'user_address'        => 'Test Address',
            'user_phone'          => '9876543210',
            'user_role'           => 'user',
            'user_remember_token' => Str::random(10),
        ]);

        $user2 = User::create([
            'user_name'           => 'Ali Hassan',
            'user_email'          => 'ali@gmail.com',
            'user_password'       => Hash::make('user123'),
            'user_address'        => 'Karachi',
            'user_phone'          => '03001234567',
            'user_role'           => 'user',
            'user_remember_token' => Str::random(10),
        ]);

        $user3 = User::create([
            'user_name'           => 'Sara Khan',
            'user_email'          => 'sara@gmail.com',
            'user_password'       => Hash::make('user123'),
            'user_address'        => 'Lahore',
            'user_phone'          => '03109876543',
            'user_role'           => 'user',
            'user_remember_token' => Str::random(10),
        ]);

        $user4 = User::create([
            'user_name'           => 'Ahmed Raza',
            'user_email'          => 'ahmed@gmail.com',
            'user_password'       => Hash::make('user123'),
            'user_address'        => 'Islamabad',
            'user_phone'          => '03334567890',
            'user_role'           => 'user',
            'user_remember_token' => Str::random(10),
        ]);

        // ============================================
        // 2. GENRES
        // ============================================
        foreach ([
            'Pop', 'Rock', 'Classical', 'Jazz', 'Hip Hop',
            'Electronic', 'R&B', 'Country', 'Folk', 'Blues',
        ] as $g) {
            Genre::create(['genre_name' => $g]);
        }

        // ============================================
        // 3. LANGUAGES
        // ============================================
        foreach ([
            'Urdu', 'English', 'Hindi', 'Punjabi', 'Arabic',
            'Spanish', 'French', 'Turkish', 'Korean', 'Japanese',
        ] as $l) {
            Language::create(['language_name' => $l]);
        }

        // ============================================
        // 4. ARTISTS
        // ============================================
        $artistsData = [
            ['artist_name' => 'Atif Aslam',          'artist_bio' => 'One of Pakistan\'s most iconic singers. Known for soulful tracks like "Tajdar-e-Haram" and "Aadat".', 'artist_image' => 'artists/atif-aslam.jpg'],
            ['artist_name' => 'Ali Zafar',            'artist_bio' => 'Pakistani singer, songwriter, and actor. Known for "Channo", "Jhoom", and "Rockstar".', 'artist_image' => 'artists/ali-zafar.jpg'],
            ['artist_name' => 'Rahat Fateh Ali Khan', 'artist_bio' => 'Legendary Pakistani singer, nephew of Nusrat Fateh Ali Khan.', 'artist_image' => 'artists/rahat-fateh-ali-khan.jpg'],
            ['artist_name' => 'Taylor Swift',         'artist_bio' => 'American singer-songwriter. Known for "Love Story", "Shake It Off", and "All Too Well".', 'artist_image' => 'artists/taylor-swift.jpg'],
            ['artist_name' => 'Ed Sheeran',           'artist_bio' => 'British singer-songwriter. Known for "Shape of You", "Perfect", and "Thinking Out Loud".', 'artist_image' => 'artists/ed-sheeran.jpg'],
            ['artist_name' => 'Billie Eilish',        'artist_bio' => 'American singer-songwriter. Known for "Bad Guy", "Lovely", and "Everything I Wanted".', 'artist_image' => 'artists/billie-eilish.jpg'],
            ['artist_name' => 'Shakira',              'artist_bio' => 'Colombian singer, songwriter, and dancer. Known for "Hips Don\'t Lie" and "Waka Waka".', 'artist_image' => 'artists/shakira.jpg'],
            ['artist_name' => 'Arijit Singh',         'artist_bio' => 'Indian playback singer. Known for "Tum Hi Ho", "Channa Mereya", and "Kesariya".', 'artist_image' => 'artists/arijit-singh.jpg'],
            ['artist_name' => 'Shreya Ghoshal',       'artist_bio' => 'Indian playback singer. Known for "Ghoomar", "Chikni Chameli", and "Deewani Mastani".', 'artist_image' => 'artists/shreya-ghoshal.jpg'],
            ['artist_name' => 'Marshmello',           'artist_bio' => 'American electronic music producer. Known for "Alone", "Happier", and "Silence".', 'artist_image' => 'artists/marshmello.jpg'],
        ];

        $artists = [];
        foreach ($artistsData as $a) {
            $artists[] = Artist::create($a);
        }

        // ============================================
        // 5. ALBUMS
        // ============================================
        $albumsData = [
            ['album_name' => 'Doorie',           'album_artist_id' => $artists[0]->id, 'album_release_year' => '2006', 'album_cover_image' => 'albums/doorie.jpg',           'album_description' => 'Atif Aslam\'s debut album featuring "Aadat" and "Woh Lamhe".'],
            ['album_name' => 'Meri Kahani',      'album_artist_id' => $artists[1]->id, 'album_release_year' => '2008', 'album_cover_image' => 'albums/meri-kahani.jpg',      'album_description' => 'Ali Zafar\'s second studio album with hits like "Channo" and "Jhoom".'],
            ['album_name' => 'Qawwali & More',   'album_artist_id' => $artists[2]->id, 'album_release_year' => '2010', 'album_cover_image' => 'albums/qawwali-more.jpg',     'album_description' => 'Collection of legendary qawwalis and classical performances.'],
            ['album_name' => '1989',             'album_artist_id' => $artists[3]->id, 'album_release_year' => '2014', 'album_cover_image' => 'albums/1989.jpg',             'album_description' => 'Taylor\'s fifth studio album featuring "Shake It Off" and "Blank Space".'],
            ['album_name' => 'Divide',           'album_artist_id' => $artists[4]->id, 'album_release_year' => '2017', 'album_cover_image' => 'albums/divide.jpg',           'album_description' => 'Ed Sheeran\'s third studio album with "Shape of You" and "Perfect".'],
            ['album_name' => 'Happier Than Ever', 'album_artist_id' => $artists[5]->id,'album_release_year' => '2021', 'album_cover_image' => 'albums/happier-than-ever.jpg', 'album_description' => 'Billie\'s second studio album with the title track "Happier Than Ever".'],
            ['album_name' => 'Oral Fixation',    'album_artist_id' => $artists[6]->id, 'album_release_year' => '2005', 'album_cover_image' => 'albums/oral-fixation.jpg',    'album_description' => 'Shakira\'s seventh studio album featuring "Hips Don\'t Lie".'],
            ['album_name' => 'Aashiqui 2',       'album_artist_id' => $artists[7]->id, 'album_release_year' => '2013', 'album_cover_image' => 'albums/aashiqui-2.jpg',       'album_description' => 'Soundtrack of the movie Aashiqui 2 featuring "Tum Hi Ho".'],
            ['album_name' => 'Ghoomar',          'album_artist_id' => $artists[8]->id, 'album_release_year' => '2018', 'album_cover_image' => 'albums/ghoomar.jpg',          'album_description' => 'Padmaavat soundtrack featuring the hit song "Ghoomar".'],
            ['album_name' => 'Joytime',          'album_artist_id' => $artists[9]->id, 'album_release_year' => '2016', 'album_cover_image' => 'albums/joytime.jpg',          'album_description' => 'Marshmello\'s debut studio album featuring "Alone".'],
        ];

        $albums = [];
        foreach ($albumsData as $a) {
            $albums[] = Album::create($a);
        }

        // ============================================
        // 6. MUSIC
        // ============================================
        $musicData = [
            ['music_title' => 'Aadat',            'music_artist_id' => $artists[0]->id, 'music_album_id' => $albums[0]->id, 'music_genre_id' => 1, 'music_language_id' => 1, 'music_year' => '2006', 'music_description' => 'Atif Aslam\'s breakthrough song.',                    'music_file_path' => null, 'music_youtube_id' => 'BGVXrFSoFmI', 'music_image_path' => 'music/aadat.jpg',            'music_is_new' => 'no'],
            ['music_title' => 'Woh Lamhe',        'music_artist_id' => $artists[0]->id, 'music_album_id' => $albums[0]->id, 'music_genre_id' => 1, 'music_language_id' => 1, 'music_year' => '2006', 'music_description' => 'Beautiful song about memories.',                   'music_file_path' => null, 'music_youtube_id' => 'zZ0cQ3dJqjI', 'music_image_path' => 'music/woh-lamhe.jpg',        'music_is_new' => 'no'],
            ['music_title' => 'Jhoom',            'music_artist_id' => $artists[1]->id, 'music_album_id' => $albums[1]->id, 'music_genre_id' => 2, 'music_language_id' => 1, 'music_year' => '2008', 'music_description' => 'Upbeat rock anthem.',                             'music_file_path' => null, 'music_youtube_id' => 'WpYeekQkAdc', 'music_image_path' => 'music/jhoom.jpg',            'music_is_new' => 'no'],
            ['music_title' => 'Channo',           'music_artist_id' => $artists[1]->id, 'music_album_id' => $albums[1]->id, 'music_genre_id' => 1, 'music_language_id' => 1, 'music_year' => '2008', 'music_description' => 'Romantic track.',                                'music_file_path' => null, 'music_youtube_id' => 'I4qLVGX4uPY', 'music_image_path' => 'music/channo.jpg',           'music_is_new' => 'no'],
            ['music_title' => 'Tajdar-e-Haram',   'music_artist_id' => $artists[2]->id, 'music_album_id' => $albums[2]->id, 'music_genre_id' => 3, 'music_language_id' => 1, 'music_year' => '2010', 'music_description' => 'Legendary qawwali.',                            'music_file_path' => null, 'music_youtube_id' => 'c8Q4oj9-Ejk', 'music_image_path' => 'music/tajdar-e-haram.jpg',   'music_is_new' => 'no'],
            ['music_title' => 'Shake It Off',     'music_artist_id' => $artists[3]->id, 'music_album_id' => $albums[3]->id, 'music_genre_id' => 1, 'music_language_id' => 2, 'music_year' => '2014', 'music_description' => 'Taylor\'s empowering anthem.',                      'music_file_path' => null, 'music_youtube_id' => 'nfWlot6h_JM', 'music_image_path' => 'music/shake-it-off.jpg',     'music_is_new' => 'no'],
            ['music_title' => 'Blank Space',      'music_artist_id' => $artists[3]->id, 'music_album_id' => $albums[3]->id, 'music_genre_id' => 1, 'music_language_id' => 2, 'music_year' => '2014', 'music_description' => 'Witty take on relationships.',                  'music_file_path' => null, 'music_youtube_id' => 'e-ORhEE9VVg', 'music_image_path' => 'music/blank-space.jpg',      'music_is_new' => 'no'],
            ['music_title' => 'Shape of You',     'music_artist_id' => $artists[4]->id, 'music_album_id' => $albums[4]->id, 'music_genre_id' => 1, 'music_language_id' => 2, 'music_year' => '2017', 'music_description' => 'Most-streamed song.',                           'music_file_path' => null, 'music_youtube_id' => 'JGwWNGJdvx8', 'music_image_path' => 'music/shape-of-you.jpg',     'music_is_new' => 'no'],
            ['music_title' => 'Perfect',          'music_artist_id' => $artists[4]->id, 'music_album_id' => $albums[4]->id, 'music_genre_id' => 1, 'music_language_id' => 2, 'music_year' => '2017', 'music_description' => 'Beautiful love song.',                          'music_file_path' => null, 'music_youtube_id' => '2Vv-BfVoq4g', 'music_image_path' => 'music/perfect.jpg',          'music_is_new' => 'no'],
            ['music_title' => 'Happier Than Ever', 'music_artist_id' => $artists[5]->id,'music_album_id' => $albums[5]->id, 'music_genre_id' => 1, 'music_language_id' => 2, 'music_year' => '2021', 'music_description' => 'Emotional breakthrough hit.',                   'music_file_path' => null, 'music_youtube_id' => '5GJWxDKyk3A', 'music_image_path' => 'music/happier-than-ever.jpg','music_is_new' => 'yes'],
            ['music_title' => 'Tum Hi Ho',        'music_artist_id' => $artists[7]->id, 'music_album_id' => $albums[7]->id, 'music_genre_id' => 1, 'music_language_id' => 3, 'music_year' => '2013', 'music_description' => 'Heartfelt Bollywood song.',                     'music_file_path' => null, 'music_youtube_id' => 'Umqb9KENgmk', 'music_image_path' => 'music/tum-hi-ho.jpg',        'music_is_new' => 'no'],
            ['music_title' => 'Channa Mereya',    'music_artist_id' => $artists[7]->id, 'music_album_id' => $albums[7]->id, 'music_genre_id' => 1, 'music_language_id' => 3, 'music_year' => '2016', 'music_description' => 'Soulful track from ADHM.',                      'music_file_path' => null, 'music_youtube_id' => '284Ov7ysmfA', 'music_image_path' => 'music/channa-mereya.jpg',    'music_is_new' => 'no'],
            ['music_title' => 'Ghoomar',          'music_artist_id' => $artists[8]->id, 'music_album_id' => $albums[8]->id, 'music_genre_id' => 3, 'music_language_id' => 3, 'music_year' => '2018', 'music_description' => 'Traditional Rajasthani folk song.',             'music_file_path' => null, 'music_youtube_id' => 'B4x9OqmHh0k', 'music_image_path' => 'music/ghoomar.jpg',          'music_is_new' => 'yes'],
            ['music_title' => 'Alone',            'music_artist_id' => $artists[9]->id, 'music_album_id' => $albums[9]->id, 'music_genre_id' => 6, 'music_language_id' => 2, 'music_year' => '2016', 'music_description' => 'Marshmello\'s iconic track.',                   'music_file_path' => null, 'music_youtube_id' => 'ALZHF5UqnU4', 'music_image_path' => 'music/alone.jpg',            'music_is_new' => 'no'],
        ];

        foreach ($musicData as $m) {
            Music::create($m);
        }

        // ============================================
        // 7. VIDEOS
        // ============================================
        $videoData = [
            ['video_title' => 'Aadat - Atif Aslam',                   'video_artist_id' => $artists[0]->id, 'video_album_id' => $albums[0]->id, 'video_genre_id' => 1, 'video_language_id' => 1, 'video_year' => '2006', 'video_description' => 'Official music video of "Aadat".',              'video_file_path' => null, 'video_youtube_id' => 'BGVXrFSoFmI', 'video_image_path' => 'videos/aadat-thumb.jpg',            'video_duration' => '4:32', 'video_is_new' => 'no'],
            ['video_title' => 'Jhoom - Ali Zafar',                    'video_artist_id' => $artists[1]->id, 'video_album_id' => $albums[1]->id, 'video_genre_id' => 2, 'video_language_id' => 1, 'video_year' => '2008', 'video_description' => 'Official music video of "Jhoom".',              'video_file_path' => null, 'video_youtube_id' => 'WpYeekQkAdc', 'video_image_path' => 'videos/jhoom-thumb.jpg',            'video_duration' => '3:45', 'video_is_new' => 'no'],
            ['video_title' => 'Tajdar-e-Haram - Rahat Fateh Ali Khan', 'video_artist_id' => $artists[2]->id, 'video_album_id' => $albums[2]->id, 'video_genre_id' => 3, 'video_language_id' => 1, 'video_year' => '2010', 'video_description' => 'Live qawwali performance.',                    'video_file_path' => null, 'video_youtube_id' => 'c8Q4oj9-Ejk', 'video_image_path' => 'videos/tajdar-thumb.jpg',           'video_duration' => '8:15', 'video_is_new' => 'no'],
            ['video_title' => 'Shake It Off - Taylor Swift',           'video_artist_id' => $artists[3]->id, 'video_album_id' => $albums[3]->id, 'video_genre_id' => 1, 'video_language_id' => 2, 'video_year' => '2014', 'video_description' => 'Official video of "Shake It Off".',            'video_file_path' => null, 'video_youtube_id' => 'nfWlot6h_JM', 'video_image_path' => 'videos/shake-it-off-thumb.jpg',     'video_duration' => '3:39', 'video_is_new' => 'no'],
            ['video_title' => 'Shape of You - Ed Sheeran',             'video_artist_id' => $artists[4]->id, 'video_album_id' => $albums[4]->id, 'video_genre_id' => 1, 'video_language_id' => 2, 'video_year' => '2017', 'video_description' => 'Official video of "Shape of You".',            'video_file_path' => null, 'video_youtube_id' => 'JGwWNGJdvx8', 'video_image_path' => 'videos/shape-of-you-thumb.jpg',     'video_duration' => '4:24', 'video_is_new' => 'no'],
            ['video_title' => 'Happier Than Ever - Billie Eilish',     'video_artist_id' => $artists[5]->id, 'video_album_id' => $albums[5]->id, 'video_genre_id' => 1, 'video_language_id' => 2, 'video_year' => '2021', 'video_description' => 'Official video of "Happier Than Ever".',        'video_file_path' => null, 'video_youtube_id' => '5GJWxDKyk3A', 'video_image_path' => 'videos/happier-than-ever-thumb.jpg', 'video_duration' => '4:58', 'video_is_new' => 'yes'],
            ['video_title' => 'Tum Hi Ho - Arijit Singh',              'video_artist_id' => $artists[7]->id, 'video_album_id' => $albums[7]->id, 'video_genre_id' => 1, 'video_language_id' => 3, 'video_year' => '2013', 'video_description' => 'Official video of "Tum Hi Ho".',                'video_file_path' => null, 'video_youtube_id' => 'Umqb9KENgmk', 'video_image_path' => 'videos/tum-hi-ho-thumb.jpg',        'video_duration' => '4:22', 'video_is_new' => 'no'],
            ['video_title' => 'Ghoomar - Shreya Ghoshal',              'video_artist_id' => $artists[8]->id, 'video_album_id' => $albums[8]->id, 'video_genre_id' => 3, 'video_language_id' => 3, 'video_year' => '2018', 'video_description' => 'Official video of "Ghoomar".',                   'video_file_path' => null, 'video_youtube_id' => 'B4x9OqmHh0k', 'video_image_path' => 'videos/ghoomar-thumb.jpg',          'video_duration' => '4:45', 'video_is_new' => 'yes'],
            ['video_title' => 'Alone - Marshmello',                    'video_artist_id' => $artists[9]->id, 'video_album_id' => $albums[9]->id, 'video_genre_id' => 6, 'video_language_id' => 2, 'video_year' => '2016', 'video_description' => 'Official video of "Alone".',                    'video_file_path' => null, 'video_youtube_id' => 'ALZHF5UqnU4', 'video_image_path' => 'videos/alone-thumb.jpg',            'video_duration' => '4:32', 'video_is_new' => 'no'],
        ];

        foreach ($videoData as $v) {
            Video::create($v);
        }

        // ============================================
        // 8. REVIEWS
        // ============================================
        $reviewsData = [
            ['review_user_id' => $user->id,  'review_media_type' => 'music', 'review_media_id' => 1,  'review_rating' => 5, 'review_text' => 'Amazing song! Atif Aslam at his best. The vocals are incredible.'],
            ['review_user_id' => $user->id,  'review_media_type' => 'music', 'review_media_id' => 2,  'review_rating' => 4, 'review_text' => 'Beautiful melody. Woh Lamhe is truly a timeless classic.'],
            ['review_user_id' => $user2->id, 'review_media_type' => 'music', 'review_media_id' => 11, 'review_rating' => 5, 'review_text' => 'Tum Hi Ho is the best Bollywood song ever. Arijit Singh is a gem!'],
            ['review_user_id' => $user2->id, 'review_media_type' => 'video', 'review_media_id' => 1,  'review_rating' => 5, 'review_text' => 'The video of Aadat brings back so many memories. Love it!'],
            ['review_user_id' => $user2->id, 'review_media_type' => 'music', 'review_media_id' => 8,  'review_rating' => 5, 'review_text' => 'Shape of You is so catchy. Ed Sheeran never disappoints!'],
            ['review_user_id' => $user3->id, 'review_media_type' => 'video', 'review_media_id' => 4,  'review_rating' => 4, 'review_text' => 'Taylor Swift\'s Shake It Off is so catchy and fun to watch!'],
            ['review_user_id' => $user3->id, 'review_media_type' => 'video', 'review_media_id' => 6,  'review_rating' => 5, 'review_text' => 'Billie Eilish is a genius. The song is hauntingly beautiful.'],
            ['review_user_id' => $user3->id, 'review_media_type' => 'music', 'review_media_id' => 10, 'review_rating' => 5, 'review_text' => 'Happier Than Ever is Billie\'s best work. Emotional and raw.'],
            ['review_user_id' => $user4->id, 'review_media_type' => 'music', 'review_media_id' => 12, 'review_rating' => 5, 'review_text' => 'Channa Mereya is pure magic. Arijit Singh\'s voice is out of this world.'],
            ['review_user_id' => $user4->id, 'review_media_type' => 'video', 'review_media_id' => 8,  'review_rating' => 4, 'review_text' => 'Ghoomar is visually stunning. The dance and music are perfect!'],
            ['review_user_id' => $user4->id, 'review_media_type' => 'music', 'review_media_id' => 4,  'review_rating' => 4, 'review_text' => 'Channo is such a romantic track. Ali Zafar nailed it.'],
        ];

        foreach ($reviewsData as $r) {
            Review::create($r);
        }

        // ============================================
        // OUTPUT
        // ============================================
        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('📌 Admin Login: admin@gmail.com / admin123');
        $this->command->info('📌 User Login: user@gmail.com / user123');
        $this->command->info('📌 Other Users: ali@gmail.com / sara@gmail.com / ahmed@gmail.com');
        $this->command->info('   (All passwords: user123)');
        $this->command->info('🎵 Total Artists: ' . Artist::count());
        $this->command->info('💿 Total Albums: ' . Album::count());
        $this->command->info('🎶 Total Music: ' . Music::count());
        $this->command->info('🎬 Total Videos: ' . Video::count());
        $this->command->info('👥 Total Users: ' . User::count());
        $this->command->info('⭐ Total Reviews: ' . Review::count());
    }
}