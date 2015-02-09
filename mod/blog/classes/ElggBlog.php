<?php
/**
 * Extended class to override the time_created
 * 
 * @property string $status      The published status of the blog post (published, draft)
 * @property string $comments_on Whether commenting is allowed (Off, On)
 * @property string $excerpt     An excerpt of the blog post used when displaying the post
 */
class ElggBlog extends ElggObject {

	/**
	 * Set subtype to blog.
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "blog";

	}
	
	/**
	 * Return an array of fields which can be exported.
	 *
	 * @return array
	 */
	public function getExportableValues() {
		return array_merge(parent::getExportableValues(), array(
			'excerpt',
			'ownerObj',
		));
	}
	
	/**
	 * Icon URL
	 */
	public function getIconURL($size = ''){
		if($this->header_bg){
			global $CONFIG;
			$base_url = $CONFIG->cdn_url ? $CONFIG->cdn_url : elgg_get_site_url();
			$image = elgg_get_site_url() . 'blog/header/'.$this->guid . '/'.$this->last_updated;
			$src = $base_url . 'thumbProxy?src='. urlencode($image) . '&c=2708';
			if($size)
				$src .= '&width='.$size;
			return $src;
		}
		return minds_fetch_image($this->description, $this->owner_guid, $size);
	}

	/**
	 * Can a user comment on this blog?
	 *
	 * @see ElggObject::canComment()
	 *
	 * @param int $user_guid User guid (default is logged in user)
	 * @return bool
	 * @since 1.8.0
	 */
	public function canComment($user_guid = 0) {
/*		$result = parent::canComment($user_guid);
		if ($result == false) {
			return $result;
		}

		if ($this->comments_on == 'Off') {
			return false;
		}
		
		return true;*/
	}

}
