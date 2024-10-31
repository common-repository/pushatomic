<?php
if( !defined('ABSPATH') ) exit;
?>


<div class="pushatomic-admin wrap" style="display: none">
	<h1 class="pushatomic-header page-title">
		<?php echo sprintf('<img src="%s" height="50px" class="pushatomic-logo">', PUSHATOMIC_DEF_BASEURL . '/resources/img/pushatomic.svg');?>
	</h1>

	<div class="pushatomic-alert-warning" id="pushatomic-https-warning">
		<?php echo __('Important: In order to work your site must be <strong>https</strong>', PUSHATOMIC_DEF_PLUGIN)?>
	</div>
	

	<div class="pushatomic-account-alert">
		<div class="pushatomic-account-inner pushatomic-flex-container">
			<div class="pushatomic-flex-item pushatomic-alert-logo">
				<?php echo sprintf('<img src="%s" height="30px" class="pushatomic-logo">', PUSHATOMIC_DEF_BASEURL . '/resources/img/pushatomic.svg');?>
			</div>

			<div class="pushatomic-flex-item">
				<p class="pushatomic-account-alert-p1"><?php echo __('Monetize your website', PUSHATOMIC_DEF_PLUGIN)?></p>
				<p class="pushatomic-account-alert-p2"><?php echo __('Up to 30% more than other solutions', PUSHATOMIC_DEF_PLUGIN)?></p>
				<p class="pushatomic-account-alert-p3"><?php echo __('Push notifications for mainstream - adult - warez', PUSHATOMIC_DEF_PLUGIN)?></p>
			</div>

			<div class="pushatomic-flex-item pushatomic-caption-btn">
				<a class="pushatomic-account-alert-button" href="https://pushatomic.com/?utm_source=wordpress_plugin" target="_blank"><?php echo __('Get your free account', PUSHATOMIC_DEF_PLUGIN)?></a>
			</div>
		</div>
	</div>

	<form class="pushatomic-form" id="pushatomic-form" method="POST">
		<input id="action" name="action" type="hidden" value="pushatomic_save_settings">
				<div class="pushatomic-section pushatomic-general">
					<h2><?php echo __('Activation', PUSHATOMIC_DEF_PLUGIN)?></h2>	

					

					<table class="form-table">
					
					<tbody>

						<tr>
							<th scope="row"><?php echo __('Pushatomic ID', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<input class="pushatomic-input" type="text" id='pushatomic-id' name='pushatomic-id' value="<?php echo $settings['pushatomic-id'];?>">
								<p class="description pushatomic-id-description"><?php echo __('Get your Pushatomic ID <a href="https://pushatomic.com/?utm_source=wordpress_plugin" target="_blank">here</a>', PUSHATOMIC_DEF_PLUGIN)?></p>
							</td>

							<td>
								<input type='submit' value='<?php echo __('Activate', PUSHATOMIC_DEF_PLUGIN)?>' id="pushatomic-activate-btn" class="pushatomic-btn pushatomic-activate">
								<input type='submit' value='<?php echo __('Change', PUSHATOMIC_DEF_PLUGIN)?>'  id="pushatomic-change-btn" class="pushatomic-btn pushatomic-activate">
								<p class="description pushatomic-id-description">&nbsp;</p>
							</td>

						</tr>
					</tbody>
				</table>
				</div>


				<div class="pushatomic-section pushatomic-general pushatomic-config">
					<h2><?php echo __('General', PUSHATOMIC_DEF_PLUGIN)?></h2>	
					<table class="form-table">
					
					<tbody>



						<tr>
							<th scope="row"><?php echo __('Enable plugin', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<label class="pushatomic-switch">
								  <input type="checkbox" class="pushatomic-checkbox" <?php if($settings['pushatomic-enabled'] == 1) echo 'checked'?> id='pushatomic-enabled' name='pushatomic-enabled' value="<?php echo $settings['pushatomic-enabled'] ?>">
								  <span class="pushatomic-slider pushatomic-round"></span>
								</label>
							</td>
						</tr>

						
						<tr>
							<th scope="row"><?php echo __('Operating mode', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<select id='pushatomic-prompt' name='pushatomic-prompt' class='pushatomic-input'>
	                           	<option value="0" <?php if( $settings['pushatomic-prompt'] == 0) echo "selected" ?> ><?php echo __('Direct (Maximize earnings)',PUSHATOMIC_DEF_PLUGIN); ?></option>
	                            <option value="1" <?php if( $settings['pushatomic-prompt'] == 1) echo "selected" ?> ><?php echo __('Prompt (Better for user experience)',PUSHATOMIC_DEF_PLUGIN); ?></option>
	                        	</select>
								<p class="description pushatomic-prompt-0"><?php echo __('Asks permission directly. Maximize earnings.', PUSHATOMIC_DEF_PLUGIN)?></p>
								<p class="description pushatomic-prompt-1"><?php echo __('Shows a previous permission prompt with personalized texts and icon', PUSHATOMIC_DEF_PLUGIN)?></p>
							</td>
						</tr>


						<tr class="pushatomic-table-button">
							<td>
								<input type='submit' value='<?php echo __('Save settings', PUSHATOMIC_DEF_PLUGIN)?>' class="pushatomic-btn pushatomic-submit">
							</td>
						</tr>
					</tbody>
				</table>
				</div>
				

				

				<div class="pushatomic-section pushatomic-prompt-settings pushatomic-config">
					<table class="form-table">
					<h2><?php echo __('Previous permission modal settings', PUSHATOMIC_DEF_PLUGIN)?></h2>


					<div class="pushatomic-prompt-preview">

						 <div class="pushatomic-prompt-preview-content">
			                <div class="pushatomic-prompt-preview-modal">

			                  <div class="pushatomic-prompt-preview-wrap" style="background-color: <?php echo $settings['pushatomic-background-color'];?>">
			  
			                    <div class="pushatomic-prompt-preview-body">
			                      
			                      <div class="pushatomic-prompt-preview-icon">
			                        
			                        <img width="80" height="80" src="" class="pushatomic-preview-icon">
			                      </div>
			  
			                      <div class="pushatomic-prompt-preview-title" style="color: <?php echo $settings['pushatomic-text-color'];?>">
			                        <?php echo wp_unslash($settings['pushatomic-title']);?>
			                      </div>
			  
			                    </div>
			  
			                    <div class="pushatomic-prompt-preview-buttons">
			                      <div class="pushatomic-prompt-preview-accept-button pushatomic-prompt-preview-button" style="background-color: <?php echo $settings['pushatomic-accept-button-background-color'];?>; color:<?php echo $settings['pushatomic-accept-button-text-color'];?>">
			                       <?php echo wp_unslash($settings['pushatomic-accept-button']);?>
			                      </div>
			                      <div class="pushatomic-prompt-preview-decline-button pushatomic-prompt-preview-button" style="background-color: <?php echo $settings['pushatomic-decline-button-background-color'];?>; color:<?php echo $settings['pushatomic-decline-button-text-color'];?>">
			                      <?php echo wp_unslash($settings['pushatomic-decline-button']);?>
			                      </div>
			                    </div>
			                    <div class="pushatomic-clearfix"></div>
			                  </div>
			  	
			                </div>
			              </div>

					</div>

					<tbody>
			
						<tr>
							<th scope="row"><?php echo __('Title', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<textarea rows="4" class="pushatomic-textarea" type="text" id='pushatomic-title' name='pushatomic-title'><?php echo wp_unslash($settings['pushatomic-title']);?></textarea>
							</td>
						</tr>

						<tr>
							<th scope="row"><?php echo __('Accept button', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<input class="pushatomic-input" type="text" id='pushatomic-accept-button' name='pushatomic-accept-button' value="<?php echo wp_unslash($settings['pushatomic-accept-button']);?>">
								
							</td>
						</tr>

						<tr>
							<th scope="row"><?php echo __('Decline button', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<input class="pushatomic-input" type="text" id='pushatomic-decline-button' name='pushatomic-decline-button' value="<?php echo wp_unslash($settings['pushatomic-decline-button']);?>">
								
							</td>
						</tr>



						<tr>
							<th scope="row"><?php echo __('Show custom icon?', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<label class="pushatomic-switch">
								  <input type="checkbox" class="pushatomic-checkbox" <?php if($settings['pushatomic-show-custom-icon'] == 1) echo 'checked'?> id='pushatomic-show-custom-icon' name='pushatomic-show-custom-icon' value="<?php echo $settings['pushatomic-show-custom-icon'] ?>">
								  <span class="pushatomic-slider pushatomic-round"></span>
								</label>
							</td>
						</tr>

						<tr class="pushatomic-custom-icon">
						<th scope="row"><?php echo __('Custom icon', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<img class="pushatomic-custom-icon-preview" src="<?php echo $settings['pushatomic-custom-icon'];?>"></img>
								<input type="hidden" name="pushatomic-custom-icon" id="pushatomic-custom-icon" value="<?php echo $settings['pushatomic-custom-icon'];?>" /> 
				                <button type="submit" class="pushatomic-custom-icon-upload button"><?php echo __('Upload', PUSHATOMIC_DEF_PLUGIN)?></button>
				                <button type="submit" class="pushatomic-custom-icon-remove button">&times;</button>
							</td>
						</tr>


						<tr>
							<th scope="row"><?php echo __('Position', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<select id='pushatomic-position' name='pushatomic-position' class='pushatomic-input'>
	                           	<option value="bottom" <?php if( $settings['pushatomic-position'] == 'bottom') echo "selected" ?> ><?php echo __('Bottom',PUSHATOMIC_DEF_PLUGIN); ?></option>
	                            <option value="top" <?php if( $settings['pushatomic-position'] == 'top') echo "selected" ?> ><?php echo __('Top',PUSHATOMIC_DEF_PLUGIN); ?></option>
	                        	</select>
							</td>
						</tr>


						<tr>
							<th scope="row"><?php echo __('Z index', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<input value="<?php echo $settings['pushatomic-z-index'];?>" id='pushatomic-z-index' name='pushatomic-z-index'  type="number" class="pushatomic-input">
								
							</td>
						</tr>


						<tr>
							<th scope="row"><?php echo __('Background color', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<input class="pushatomic-input-color pushatomic-input" id='pushatomic-background-color' name='pushatomic-background-color' value="<?php echo $settings['pushatomic-background-color'];?>">
							</td>
						</tr>


						<tr>
							<th scope="row"><?php echo __('Font color', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<input class="pushatomic-input-color pushatomic-input" id='pushatomic-text-color' name='pushatomic-text-color' value="<?php echo $settings['pushatomic-text-color'];?>">
							</td>
						</tr>

						

						<tr>
							<th scope="row"><?php echo __('Accept button background color', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<input class="pushatomic-input-color pushatomic-input" id='pushatomic-accept-button-background-color' name='pushatomic-accept-button-background-color' value="<?php echo $settings['pushatomic-accept-button-background-color'];?>">
							</td>
						</tr>


						<tr>
							<th scope="row"><?php echo __('Accept button font color', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<input class="pushatomic-input-color pushatomic-input" id='pushatomic-accept-button-text-color' name='pushatomic-accept-button-text-color' value="<?php echo $settings['pushatomic-accept-button-text-color'];?>">
							</td>
						</tr>


						<tr>
							<th scope="row"><?php echo __('Decline button background color', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<input class="pushatomic-input-color pushatomic-input" id='pushatomic-decline-button-background-color' name='pushatomic-decline-button-background-color' value="<?php echo $settings['pushatomic-decline-button-background-color'];?>">
							</td>
						</tr>


						<tr>
							<th scope="row"><?php echo __('Decline button font color', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<input class="pushatomic-input-color pushatomic-input" id='pushatomic-decline-button-text-color' name='pushatomic-decline-button-text-color' value="<?php echo $settings['pushatomic-decline-button-text-color'];?>">
							</td>
						</tr>
						
						<tr>
							<td>
								<input type='submit' value='<?php echo __('Save settings', PUSHATOMIC_DEF_PLUGIN)?>' class="pushatomic-btn pushatomic-submit">
							</td>
						</tr>
					</tbody>
				</table>
				</div>

				<div class="pushatomic-section prompt-behaviour pushatomic-config">
					<table class="form-table pushatomic-prompt-behaviour">
					<h2><?php echo __('Behaviour', PUSHATOMIC_DEF_PLUGIN)?></h2>
					<tbody>


						<tr>
							<th scope="row"><?php echo __('Ask permission on', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<select id='pushatomic-devices' name='pushatomic-devices' class='pushatomic-input'>
		                           	<option value="all" <?php if( $settings['pushatomic-devices'] == 'all') echo "selected" ?> ><?php echo __('Desktop and mobile',PUSHATOMIC_DEF_PLUGIN); ?></option>
		                            <option value="mobile" <?php if( $settings['pushatomic-devices'] == 'mobile') echo "selected" ?> ><?php echo __('Only mobile',PUSHATOMIC_DEF_PLUGIN); ?></option>
	                            	<option value="desktop" <?php if( $settings['pushatomic-devices'] == 'desktop') echo "selected" ?> ><?php echo __('Only desktop',PUSHATOMIC_DEF_PLUGIN); ?></option>
	                        	</select>
							</td>
						</tr>

						<tr class="pushatomic-prompt-settings">
							<th scope="row"><?php echo __('Closed days', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<input class="pushatomic-input" type="number" id='pushatomic-closed-days' name='pushatomic-closed-days' value="<?php echo $settings['pushatomic-closed-days'];?>">
								<p class="description"><?php echo __('Ask again after the indicated days', PUSHATOMIC_DEF_PLUGIN)?></p>
							</td>
						</tr>

						<tr>
							<th scope="row"><?php echo __('Trigger mode', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<select id='pushatomic-trigger-mode' name='pushatomic-trigger-mode' class='pushatomic-input'>
	                           		<option value="instant" <?php if( $settings['pushatomic-trigger-mode'] == 'instant') echo "selected" ?> ><?php echo __('Instant',PUSHATOMIC_DEF_PLUGIN); ?></option>
	                           		<option value="timeout" <?php if( $settings['pushatomic-trigger-mode'] == 'timeout') echo "selected" ?> ><?php echo __('Timeout',PUSHATOMIC_DEF_PLUGIN); ?></option>
	                           		<option value="scroll" <?php if( $settings['pushatomic-trigger-mode'] == 'scroll') echo "selected" ?> ><?php echo __('Scroll',PUSHATOMIC_DEF_PLUGIN); ?></option>
	                        	</select>
							</td>
						</tr>

						<tr id="pushatomic-trigger-timeout-row">
							<th scope="row"><?php echo __('Timeout trigger in seconds', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<input class="pushatomic-input" type="number" id='pushatomic-trigger-timeout' name='pushatomic-trigger-timeout' value="<?php echo $settings['pushatomic-trigger-timeout'];?>">
								<p class="description"><?php echo __('Ask permission after the indicated seconds', PUSHATOMIC_DEF_PLUGIN)?></p>
							</td>
						</tr>


						<tr id="pushatomic-trigger-scroll-row">
							<th scope="row"><?php echo __('Scroll trigger', PUSHATOMIC_DEF_PLUGIN)?></th>
							<td>
								<input class="pushatomic-input" type="number" id='pushatomic-trigger-scroll' name='pushatomic-trigger-scroll' value="<?php echo $settings['pushatomic-trigger-scroll'];?>">
								<p class="description"><?php echo __('Ask permission when user scrolls the indicated pixels', PUSHATOMIC_DEF_PLUGIN)?></p>
							</td>
						</tr>

						<tr>
							<td>
								<input type='submit' value='<?php echo __('Save settings', PUSHATOMIC_DEF_PLUGIN)?>' class="pushatomic-btn pushatomic-submit">
							</td>
						</tr>


					</tbody>
				</table>
				</div>	
	</form>
	<span><?php echo PUSHATOMIC_DEF_PLUGIN_NAME . " " . PUSHATOMIC_VERSION ?></span>		
</div>

	