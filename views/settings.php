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
?>
<div class="Header"><?php
		echo Wrap(T($this->data('Title')), 'h3');
		echo Wrap(T($this->data('PluginDescription')), 'div', array('class' => 'Info'));
	?>
</div>
<div class="Content"><?php
    echo $this->Form->Open();
    echo $this->Form->Errors();
    echo Wrap(T('Settings'), 'h3');
    echo Wrap(
            Wrap(
                    $this->Form->Label(t('Threshold'), 'AutoBury.Threshold') . 
                    $this->Form->Textbox('AutoBury.Threshold', array('maxlength' => '3')), 'li'), 'ul');
    echo $this->Form->Close('Save');
    ?>
<div class="Footer">
    <?php
    echo Wrap(T('Feedback'), 'h3');
    ?>
    <div class="Aside Box">
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="KX6GTXVM3J358">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>
    </div>
    <?php
    echo Wrap('Find this plugin helpful? Want to support a freelance developer?<br/>Click the donate button to buy me a beer. :D', 'div', array('class' => 'Info'));
    echo Wrap('Confused by something? <strong><a href="http://vanillaforums.org/post/discussion?AddonID=923">Ask a question</a></strong> about Auto Bury on the official <a href="http://vanillaforums.org/discussions" target="_blank">Vanilla forums</a>.', 'div', array('class' => 'Info'));
    ?>
</div>
<?php
