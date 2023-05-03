<?php

namespace App\Http\Controllers;
use App\Models\Novel;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Contract\Firestore;

class NovelController extends Controller
{
    public function getAllNovels(Request $request){
        // Launch Firebase Auth
        $auth = app('firebase.auth');
        // Retrieve the Firebase credential's token
        $idTokenString = $request->input('Firebasetoken');
        try { // Try to verify the Firebase credential token with Google

            $verifiedIdToken = $auth->verifyIdToken($idTokenString);

        } catch (\InvalidArgumentException $e) { // If the token has the wrong format

            return response()->json([
                'message' => 'Unauthorized - Can\'t parse the token: ' . $e->getMessage()
            ], 401);

        } catch (InvalidToken $e) { // If the token is invalid (expired ...)

            return response()->json([
                'message' => 'Unauthorized - Token is invalide: ' . $e->getMessage()
            ], 401);

        }
        $firestore = app('firebase.firestore');
        $database = $firestore->database('');

        // Get the Firestore collection you want to fetch
        $collection = $database->collection('novels');

        // Get the documents in the collection
        $documents = $collection->documents();
        // Process the fetched data as per your requirements
        $novels = [];
        foreach ($documents as $document) {
            $novels[] = $document->data();
        }
        return response()->json([
            'allNovels' => $novels
        ], 200);
    }
    public function getTopThreeNovels(Request $request){
        // Launch Firebase Auth
        $auth = app('firebase.auth');
        // Retrieve the Firebase credential's token
        $idTokenString = $request->input('Firebasetoken');
        try { // Try to verify the Firebase credential token with Google

            $verifiedIdToken = $auth->verifyIdToken($idTokenString);

        } catch (\InvalidArgumentException $e) { // If the token has the wrong format

            return response()->json([
                'message' => 'Unauthorized - Can\'t parse the token: ' . $e->getMessage()
            ], 401);

        } catch (InvalidToken $e) { // If the token is invalid (expired ...)

            return response()->json([
                'message' => 'Unauthorized - Token is invalide: ' . $e->getMessage()
            ], 401);

        }
        $firestore = app('firebase.firestore');
        $database = $firestore->database('');

        // Get the Firestore collection you want to fetch
        $collection = $database->collection('novels');

        // Get the documents in the collection
        $documents = $collection->orderBy('previous_rank', 'asc')->limit(3)->documents();
        // Process the fetched data as per your requirements
        $novels = [];
        foreach ($documents as $document) {
            $novels[] = $document->data();
        }
        return response()->json([
            'allNovels' => $novels
        ], 200);
    }
    public function getNewNovels(Request $request){
        // Launch Firebase Auth
        $auth = app('firebase.auth');
        // Retrieve the Firebase credential's token
        $idTokenString = $request->input('Firebasetoken');
        try { // Try to verify the Firebase credential token with Google

            $verifiedIdToken = $auth->verifyIdToken($idTokenString);

        } catch (\InvalidArgumentException $e) { // If the token has the wrong format

            return response()->json([
                'message' => 'Unauthorized - Can\'t parse the token: ' . $e->getMessage()
            ], 401);

        } catch (InvalidToken $e) { // If the token is invalid (expired ...)

            return response()->json([
                'message' => 'Unauthorized - Token is invalide: ' . $e->getMessage()
            ], 401);

        }
        $firestore = app('firebase.firestore');
        $database = $firestore->database('');

        // Get the Firestore collection you want to fetch
        $collection = $database->collection('novels');
        // Get the current date and time in the UTC timezone
        $now = new \DateTime('now', new \DateTimeZone('UTC'));

// Get the start and end dates of the current week in the UTC timezone
        $startOfWeek = clone $now;
        $startOfWeek->modify('last monday')->setTime(0, 0, 0);
        $endOfWeek = clone $now;
        $endOfWeek->modify('next monday')->setTime(0, 0, 0);

// Query Firestore for the novels published within the current week
        $query = $collection
            ->where('release_date', '>=', $startOfWeek)
            ->where('release_date', '<', $endOfWeek)
            ->orderBy('release_date', 'desc');
        $documents = $query->documents();
        // Process the fetched data as per your requirements
        $novels = [];
        foreach ($documents as $document) {
            $novels[] = $document->data();
        }
        return response()->json([
            'allNovels' => $novels
        ], 200);
    }
    public function getTopThreeNovelsPower(Request $request){
        // Launch Firebase Auth
        $auth = app('firebase.auth');
        // Retrieve the Firebase credential's token
        $idTokenString = $request->input('Firebasetoken');
        try { // Try to verify the Firebase credential token with Google

            $verifiedIdToken = $auth->verifyIdToken($idTokenString);

        } catch (\InvalidArgumentException $e) { // If the token has the wrong format

            return response()->json([
                'message' => 'Unauthorized - Can\'t parse the token: ' . $e->getMessage()
            ], 401);

        } catch (InvalidToken $e) { // If the token is invalid (expired ...)

            return response()->json([
                'message' => 'Unauthorized - Token is invalide: ' . $e->getMessage()
            ], 401);

        }
        $firestore = app('firebase.firestore');
        $database = $firestore->database('');

        // Get the Firestore collection you want to fetch
        $collection = $database->collection('novels');

        $documents = $collection->orderBy('coins', 'desc')->limit(3)->documents();
        // Process the fetched data as per your requirements
        $novels = [];
        foreach ($documents as $document) {
            $novels[] = $document->data();
        }
        return response()->json([
            'allNovels' => $novels
        ], 200);
    }
    public function getTopThreeNovelsReaders(Request $request){
        // Launch Firebase Auth
        $auth = app('firebase.auth');
        // Retrieve the Firebase credential's token
        $idTokenString = $request->input('Firebasetoken');
        try { // Try to verify the Firebase credential token with Google

            $verifiedIdToken = $auth->verifyIdToken($idTokenString);

        } catch (\InvalidArgumentException $e) { // If the token has the wrong format

            return response()->json([
                'message' => 'Unauthorized - Can\'t parse the token: ' . $e->getMessage()
            ], 401);

        } catch (InvalidToken $e) { // If the token is invalid (expired ...)

            return response()->json([
                'message' => 'Unauthorized - Token is invalide: ' . $e->getMessage()
            ], 401);

        }
        $firestore = app('firebase.firestore');
        $database = $firestore->database('');

        // Get the Firestore collection you want to fetch
        $collection = $database->collection('novels');

        $documents = $collection->orderBy('readers', 'desc')->limit(3)->documents();
        // Process the fetched data as per your requirements
        $novels = [];
        foreach ($documents as $document) {
            $novels[] = $document->data();
        }
        return response()->json([
            'allNovels' => $novels
        ], 200);
    }
    public function getWeeklyNovels(Request $request){
        // Launch Firebase Auth
        $auth = app('firebase.auth');
        // Retrieve the Firebase credential's token
        $idTokenString = $request->input('Firebasetoken');
        try { // Try to verify the Firebase credential token with Google

            $verifiedIdToken = $auth->verifyIdToken($idTokenString);

        } catch (\InvalidArgumentException $e) { // If the token has the wrong format

            return response()->json([
                'message' => 'Unauthorized - Can\'t parse the token: ' . $e->getMessage()
            ], 401);

        } catch (InvalidToken $e) { // If the token is invalid (expired ...)

            return response()->json([
                'message' => 'Unauthorized - Token is invalide: ' . $e->getMessage()
            ], 401);

        }
        $firestore = app('firebase.firestore');
        $database = $firestore->database('');

        // Get the Firestore collection you want to fetch
        $collection = $database->collection('novels');

        $documents = $collection->orderBy('chapters', 'desc')->limit(10)->documents();
        // Process the fetched data as per your requirements
        $novels = [];
        foreach ($documents as $document) {
            $novels[] = $document->data();
        }
        return response()->json([
            'allNovels' => $novels
        ], 200);
    }
    public function getUserGifts(Request $request, $id){
        // Launch Firebase Auth
        $auth = app('firebase.auth');
        // Retrieve the Firebase credential's token
        $idTokenString = $request->input('Firebasetoken');
        try { // Try to verify the Firebase credential token with Google

            $verifiedIdToken = $auth->verifyIdToken($idTokenString);

        } catch (\InvalidArgumentException $e) { // If the token has the wrong format

            return response()->json([
                'message' => 'Unauthorized - Can\'t parse the token: ' . $e->getMessage()
            ], 401);

        } catch (InvalidToken $e) { // If the token is invalid (expired ...)

            return response()->json([
                'message' => 'Unauthorized - Token is invalide: ' . $e->getMessage()
            ], 401);

        }
        $firestore = app('firebase.firestore');
        $database = $firestore->database('');

        // Get the Firestore collection you want to fetch
        $collection = $database->collection('Users');

        $documents = $collection->documents();
        // get the gifts id
        $gifts_id = [];
        $gifts_id = $document->data()['gifts'];
        return response()->json([
            'allNovels' => $novels
        ], 200);
    }
}
