<?php

namespace App\Transformer\Api;

use App\{Hashtag, Status, StatusHashtag};
use League\Fractal;

class StatusHashtagTransformer extends Fractal\TransformerAbstract
{
	public function transform(StatusHashtag $statusHashtag)
	{
		$hashtag = $statusHashtag->hashtag;
		$status = $statusHashtag->status;
		$profile = $statusHashtag->profile;

		return [
			'status' => [
				'type' => $status->type,
				'url' => $status->url(),
				'thumb' => $status->thumb(),
				'sensitive' => (bool) $status->is_nsfw,
				'like_count' => $status->likes_count,
				'share_count' => $status->reblogs_count,
				'user' => [
					'username' 	=> $profile->username,
					'url'		=> $profile->url(),
				]
			],
			'hashtag' => [
				'name' => $hashtag->name,
				'url'  => $hashtag->url(),
			]
		];
	}
}