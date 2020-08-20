<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicCreateRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Http\Resources\TopicResource;
use App\Post;
// use Illuminate\Http\Request;
use App\Topic;

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

		return new TopicResource($topic);
	}
}
