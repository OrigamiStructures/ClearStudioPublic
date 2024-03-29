<?php

/*
 * MenuTable generates arrays that can be translated into nested navigation tools
 * 
 * Navigation lists are built from standing arrays and synthesized from values 
 * stored in teh SystemState property. No data tables exist.
 * 
 * Copyright 2015 Origami Structures
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use App\Model\Table\AppTable;
use Cake\Collection\Collection;

/**
 * CakePHP MenusTable
 * @author jasont
 */
class MenusTable extends AppTable{
	
    public $menu = ['Artwork' => []];
    
    protected $clearStudio = ['ClearStudio' => '/'];
	
	protected $pricing = ['Pricing' => 'pricing/index'];
	protected $account = ['Account' => [
			'Login' => '/users/users/login',
			'Logout' => '/users/users/logout',
			'Edit My Profile' => '/users/users/profile',
			'Update Payment Type' => '/users/updatePayment'
		]];


	public function initialize(array $config) {
		parent::initialize($config);
	}
	
	/**
	 * Call point to get a main navigation menu
	 * 
	 * @return array
	 */
	public function assemble() {
		$this->template();
		return $this->menu;
	}
	
	/**
	 * Establish the main menu keys and thier order
	 */
	protected function template() {
		$this->menu = $this->clearStudio + $this->pricing + $this->account;
	}

		/**
	 * Makes an Artwork stack menu for the current context
	 */
	protected function artwork() {
		$this->addArtworks();
		$this->addEditions();
		$this->addFormats();
	}
	
	protected function members() {
	}
	
	protected function disposition() {
	}
	
	protected function account() {
	}
	
	/**
	 * Set up the admin menus for the current circumstance
	 */
	protected function admin() {
		if (!$this->SystemState->admin()) {
			unset($this->menu['Admin']);
		} else {
			// all admins have 'artist spoofing' capabilities
			$this->menu['Admin'] = 
				[
					'Act as me' => [],
					// Acts as should be a list if there are few than ???
					// after that limit it should be a link to a choice page. 
					// Probably a User/Account call to discover the list?
					'Act as...' => [], //$User->artists(),
				];
		}
		if ($this->SystemState->admin(ADMIN_SYSTEM)){
			$this->menu['Admin']['Logs'] = [];
			$this->menu['Admin']['Remap States'] = '/artworks/map_states';
		}
	}

	/**
	 * Generate navigation choices from a page of Artworks records
	 * 
	 * Will produce both a Refine and Review link for each Artwork.
	 * Will work automatically for the standard $artworks array that is 
	 * used to render views, or the $artwork variable if only one is known 
	 * 
	 * COMBINE EVERYTHING INTO A SINGLE LOOP?
	 * 
	 * @return array
	 */
	protected function addArtworks() {
		if (is_null($this->SystemState->menu_artworks)) {
			if (is_null($this->SystemState->menu_artwork)) {
					return;
			}
			$artworks = [$this->SystemState->menu_artwork];
		} else {
			$artworks = $this->SystemState->menu_artworks;
		}
		$combined = (new Collection($artworks))->combine(
			function($artworks) { return $artworks->title; }, 
			function($artworks) { return "/artworks/refine?artwork={$artworks->id}"; }
		);
		$this->menu['Artwork']['Refine Artwork'] = $combined->toArray();
		$combined = (new Collection($artworks))->combine(
			function($artworks) { return $artworks->title; }, 
			function($artworks) { return "/artworks/review?artwork={$artworks->id}"; }
		);
		$this->menu['Artwork']['Review Artwork'] = $combined->toArray();
	}
	
	/**
	 * Generate navigation choices from a single Artwork record
	 * 
	 * Will produce both Refine and Review links for each Edition in the 
	 * Arwork. SHOULD ALSO PRODUCE Refine and Review for the Formats?
	 * 
	 * @return array
	 */
	protected function addEditions(){
		
		// NEW RULE - not everything allows create
		
		if (is_null($this->SystemState->menu_artwork)) {
			return;
		}
		$editions = $this->SystemState->menu_artwork->editions;
		
		$refine = (new Collection($editions))->combine(
			function($editions) { return $editions->display_title; }, 
			function($editions) { return "/editions/refine?artwork={$editions->artwork_id}&edition={$editions->id}"; }
		);
		$review = (new Collection($editions))->combine(
			function($editions) { return $editions->display_title; },
			function($editions) { return "/editions/review?artwork={$editions->artwork_id}&edition={$editions->id}"; }
		);
			$refine = $refine->toArray();
			$review = $review->toArray();
		if (count($refine) === 1) {
			$refine = array_pop($refine);
			$review = array_pop($review);
		}

		$this->menu['Artwork']['Edition'] = [
			'Create' => "/editions/create?artwork={$this->SystemState->menu_artwork->id}",
			'Refine' => $refine,
			'Review' => $review,
		];
	}
	
	protected function addFormats() {
		
		// NEW RULE - not everything allows create
		
		if (is_null($this->SystemState->menu_artwork)) {
			return;
		}
		$editions = $this->SystemState->menu_artwork->editions;
		$many_editions = count($editions) > 1;
		
		foreach ($editions as $index => $edition) {
			$formats = $edition->formats;
			$query_args = "?artwork={$edition->artwork_id}&edition={$edition->id}";
			
			$refine = $review = [];
			foreach ($edition->formats as $index => $format) {
				$refine[$format->display_title] = "/formats/refine$query_args&format={$format->id}";
				$review[$format->display_title] = "/formats/review$query_args&format={$format->id}";
			}
			if (count($refine) === 1) {
				$refine = array_pop($refine);
				$review = array_pop($review);
			}
			
			if ($many_editions) {
				$this->menu['Artwork']['Format'][$edition->display_title] = [
					'Create' => $this->allowNewFormat($edition) ? "/formats/create$query_args" : [],
					'Refine' => $refine,
					'Review' => $review
				];
			} else {
				$this->menu['Artwork']['Format'] = [
					'Create' => $this->allowNewFormat($edition) ? "/formats/create$query_args" : [],
					'Refine' => $refine,
					'Review' => $review
			];
			}
		}
	}
	
	protected function allowNewFormat($edition) {
		return in_array($edition->type, SystemState::multiFormatEditionTypes());
	}

}
