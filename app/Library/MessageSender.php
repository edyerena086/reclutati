<?php

namespace ReclutaTI\Library;

use ReclutaTI\Message;

class MessageSender
{
	/**
	 * [send description]
	 * @param  [type] $sender          [description]
	 * @param  [type] $addresses       [description]
	 * @param  [type] $title           [description]
	 * @param  [type] $message         [description]
	 * @param  [type] $parentMessageId [description]
	 * @return [type]                  [description]
	 */
	public static function send($sender, $addresses, $title = null, $message, $parentMessageId = null)
	{
		$record = new Message();

		$record->sender = $sender;
		$record->addresses = $addresses;
		if ($title != null) {
			$record->title = $title;
		}
		$record->message = $message;
		$record->parent_id ($parentMessageId == null) ? 0 : $parentMessageId;

		if ($record->save()) {
			return true;
		} else {
			return false;
		}
	}
}