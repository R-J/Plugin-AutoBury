<?php if (!defined('APPLICATION')) exit();
/*	Copyright 2016 Zachary Doll
 *	This program is free software; you can redistribute it and/or
 *  modify it under the terms of the GNU General Public License
 *  as published by the Free Software Foundation; either version 2
 *  of the License, or (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License
 *	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

$PluginInfo['AutoBury'] = array(
	'Name' => 'Auto Bury',
	'Description' => 'Automatically buries comments and discussions, preventing them from being shown.',
	'Version' => '0.1',
	'RequiredApplications' => array('Vanilla' => '2.2', 'Yaga' => '1.1'),
	'MobileFriendly' => true,
	'HasLocale' => true,
	'RegisterPermissions' => false,
	'SettingsUrl' => '/settings/autobury',
	'SettingsPermission' => 'Garden.Settings.Manage',
	'Author' => 'Zachary Doll',
	'AuthorEmail' => 'hgtonight@daklutz.com',
	'AuthorUrl' => 'http://www.daklutz.com',
	'License' => 'GPLv2'
);

class AutoBury extends Gdn_Plugin {
	
    public function settingsController_autoBury_create($sender) {
        $sender->setData('Title', $this->getPluginKey('Name'));
        $sender->permission('Garden.Settings.Manage');
        $sender->setData('PluginDescription', $this->getPluginKey('Description'));
        $validation = new Gdn_Validation();
        $configurationModel = new Gdn_ConfigurationModel($validation);
        $configurationModel->setField(array(
            'AutoBury.Threshold' => -5,
        ));
        $sender->Form->setModel($configurationModel);
        
        if ($sender->Form->authenticatedPostBack() === false) {
            $sender->Form->setData($configurationModel->Data);
        } else {
            $configurationModel->Validation->applyRule('AutoBury.Threshold', 'Required');
            if ($sender->Form->save()) {
                $sender->informMessage('<span class="InformSprite Sliders"></span>' . t('Your changes have been saved.'), 'HasSprite');
            }
        }
        $sender->render($this->getView('settings.php'));
    }
    
    public function discussionsController_beforeDiscussionName_handler($sender) {
      $this->bury('Discussion', $sender);
    }
    
    public function discussionController_beforeCommentDisplay_handler($sender) {
      $this->bury('Comment', $sender);
    }
    
    private function bury($objectName, $sender) {
      $object = $sender->EventArguments[$objectName];
      if(!is_null($object->Score) && $object->Score < c('AutoBury.Threshold', -5)) {
          $sender->EventArguments['CssClass'] .= ' Buried';
      }
    }
    
    public function discussionsController_render_before($sender) {
        $this->addResources($sender);
    }
    
    public function discussionController_render_before($sender) {
        $this->addResources($sender);
    }
	
	private function addResources($sender) {
        $sender->addDefinition('AutoBury.Translation', t('This item is buried, click to show'));
		$sender->addJsFile($this->getResource('js/autobury.js', false, false));
		$sender->addCssFile($this->getResource('design/autobury.css', false, false));
    }
}
