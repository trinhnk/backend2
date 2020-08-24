<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicCreateRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Http\Resources\TopicResource;
use App\Post;
// use Illuminate\Http\Request;
use App\Topic;
use App\User;

class TopicController extends Controller
{
    public function store(TopicCreateRequest $request) {
		$topic = new Topic;
		$topic->title = $request->title;
		$topic->user()->associate($request->user());

		$post = new Post;
		$post->body = $request->body;
		$post->user()->associate($request->user());

		$topic->save();
		$topic->posts()->save($post);

		return (new TopicResource($topic));
		// return response()
		// 	->json([
		// 		"message" => "Topic creation has been successful",
		// 		"status" => 200
		// 	]);
	}

	public function index() {
		$topics = Topic::latestFirst()->paginate(3);
		// dd(TopicResource::collection($topics));
		return TopicResource::collection($topics);
	}

	public function show(Topic $topic) {
		return new TopicResource($topic);
	}

	public function update(UpdateTopicRequest $request, Topic $topic) {
		$this->authorize('update', $topic);
		// if ( !(\Auth::user()->id === $topic->user->id)) {
		// 	return response()
		// 	->json([
		// 		"message" => "This action is unauthorized.",
		// 		"status" => 403
		// 	]);
		// }

		$topic->title = $request->get('title', $topic->title);
		// $topic->title = $request->title;
		$topic->save();
		return new TopicResource($topic);
	}

	public function destroy(Topic $topic) {
		$this->authorize('destroy', $topic);
		$topic->delete();
		return response(null, 204);
	}
}
