<?php
/**
* @package		Komento
* @copyright	Copyright (C) 2012 Stack Ideas Private Limited. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Komento is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Restricted access'); ?>
<div class="row-fluid">
	<div class="span2">
		<div id="sidebar">
			<h4 class="page-header"><?php echo JText::_( 'COM_KOMENTO_FILTER' ); ?>:</h4>

			<div class="filter-select hidden-phone">

				<?php echo $this->component; ?>
				<hr class="hr-condensed" />
			</div>
		</div>
	</div>

	<div class="span10">
		<table class="table table-striped" cellspacing="1">
		<thead>

			<!--

			Row
				Number
				Checkbox
				Comment
				Published
				Parent
				Component
				Article Id
				Date
				Author
				ID

			-->

			<tr>
				<th width="1%"><?php echo JText::_( 'COM_KOMENTO_COLUMN_NUM' ); ?></th>
				<th width="1%"><input type="checkbox" name="toggle" value="" onClick="Joomla.checkAll(this);" /></th>
				<th width="30%"><?php echo JText::_( 'COM_KOMENTO_COLUMN_COMMENT' ); ?></th>
				<th width="5%"><?php echo JText::_( 'COM_KOMENTO_COLUMN_STATUS' ); ?></th>
				<th width="5%"><?php echo JText::_( 'COM_KOMENTO_COLUMN_COMMENT_PARENT' ); ?></th>
				<th width="10%"><?php echo JHTML::_( 'grid.sort', JText::_( 'COM_KOMENTO_COLUMN_COMPONENT' ), 'component', $this->orderDirection, $this->order ); ?></th>
				<th width="10%"><?php echo JHTML::_( 'grid.sort', JText::_( 'COM_KOMENTO_COLUMN_ARTICLE' ), 'cid', $this->orderDirection, $this->order ); ?></th>
				<th width="10%"><?php echo JHTML::_( 'grid.sort', JText::_( 'COM_KOMENTO_COLUMN_DATE' ), 'created', $this->orderDirection, $this->order ); ?></th>
				<th width="10%"><?php echo JHTML::_( 'grid.sort', JText::_( 'COM_KOMENTO_COLUMN_AUTHOR' ) , 'created_by', $this->orderDirection, $this->order ); ?></th>
				<th width="5%"><?php echo JHTML::_( 'grid.sort', JText::_( 'COM_KOMENTO_COLUMN_ID' ) , 'id', $this->orderDirection, $this->order ); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		if( $this->comments )
		{
			$k = 0;
			$x = 0;
			$config	= JFactory::getConfig();
			for ($i=0, $n=count($this->comments); $i < $n; $i++)
			{
				$row			= Komento::getHelper( 'comment' )->process( $this->comments[$i], 1 );
				// $link 			= 'index.php?option=com_komento&amp;controller=comment&amp;task=edit&amp;commentid='. $row->id;
				$userlink		= JURI::root() . 'index.php?option=com_komento&amp;view=blogger&amp;layout=listBlogs&amp;id='. $row->created_by;
			?>

			<!--

			Row
				Number
				Checkbox
				Comment
				Parent
				Component
				Article Id
				Action
				Date
				Author
				ID

			-->

			<tr id="<?php echo 'kmt-' . $row->id; ?>" class="<?php echo "row$k"; ?>">

				<!-- Row Number -->
				<td class="center">
					<?php echo $this->pagination->getRowOffset( $i ); ?>
				</td>

				<!-- Checkbox -->
				<td class="center">
					<?php echo JHTML::_('grid.id', $x++, $row->id); ?>
				</td>

				<!-- Comment -->
				<td>
					<?php echo $row->comment; ?>
				</td>

				<td class="published-cell center">
					<?php if( $row->published == 2 ) { ?>
						<a title="<?php echo JText::_('COM_KOMENTO_PUBLISH_ITEM'); ?>" onclick="return listItemTask('cb<?php echo $i; ?>', 'publish')" href="javascript:void(0);">
							<img alt="<?php echo JText::_('COM_KOMENTO_MODERATE'); ?>" src="components/com_komento/assets/images/pending-favicon.png" />
						</a>
					<?php } else {
						if( $row->published != 1 ) {
							$row->published = 0;
						}
						echo JHTML::_('jgrid.published', $row, $i );
					} ?>
				</td>

				<!-- Parent -->
				<td class="center">
					<?php if($row->parent_id) { ?>
					<a href="<?php echo JRoute::_('index.php?option=com_komento&amp;view=comments&amp;controller=comment&amp;nosearch=1&amp;parentid=' . $row->parent_id); ?>"><?php echo JText::_('COM_KOMENTO_VIEW_PARENT'); ?></a>
					<?php } else {
						echo JText::_('COM_KOMENTO_NO_PARENT');
					} ?>
				</td>

				<!-- Component -->
				<td class="center">
					<?php echo $row->componenttitle; ?>
				</td>

				<!-- Article Title
					todo::link to article page view=article or link to edit article page task=edit?
				-->
				<td class="center">
					<?php if( $row->extension ) { ?>
					<a href="<?php echo $row->pagelink; ?>"><?php echo $row->contenttitle; ?></a>
					<?php } else { ?>
					<span class="error"><?php echo $row->contenttitle; ?></span>
					<?php } ?>
				</td>

				<!-- Date -->
				<td class="center">
					<?php echo $row->unformattedDate; ?>
				</td>

				<!-- Author -->
				<td class="center">
					<?php echo $row->name; ?>
				</td>

				<!-- ID -->
				<td class="center">
					<?php if( $row->extension ) { ?>
					<a href="<?php echo $row->permalink; ?>"><?php echo $row->id; ?></a>
					<?php } else { ?>
					<span class="error"><?php echo $row->id; ?></span>
					<?php } ?>
				</td>
			</tr>
			<?php $k = 1 - $k; } ?>
		<?php
		}
		else
		{
		?>
			<tr>
				<td align="center" colspan="10">
					<?php echo JText::_('COM_KOMENTO_COMMENTS_NO_COMMENT');?>
				</td>
			</tr>
		<?php
		}
		?>
		</tbody>

		<tfoot>
			<tr>
				<td colspan="10">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		</table>
	</div>

</div>
