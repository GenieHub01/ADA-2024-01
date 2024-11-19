<?php
/* @var $this CategoryController */
/* @var $dataProvider CActiveDataProvider */

if ($model !== null) {
    $this->pageTitle = $model->getPageTitle();
    $this->seo_keywords = $model->url;
    $this->seo_description = $model->getSeoDescription();
}
Yii::app()->clientScript->registerScriptFile('/js/regions.js');
Yii::app()->clientScript->registerScriptFile('/js/category.js');
?>

</div>
</div>


<section id="company-list-title">
    <div class="container">
        <h1 id="category-anchor"><strong>Company</strong> list</h1>
    </div>
</section>

<div class="container catergory-index ">
	<div class="col-md-12 company-list">
		<p class="company-list-puprose">
			<span>Enter <strong>your location</strong>,</span>
			<span>and let us help you <strong>sort the adverts</strong>.</span>
		</p>
		<div class="col-md-4 company-list-left">	
			<div class="list-tree-block">
				<?php
					$this->widget('CTreeView', [
						'data' => $treeViewData,
						'collapsed' => true,
						'persist' => 'location',
						'cssFile' => '/css/jquery.treeview.css',
						'htmlOptions' => [
						]
					]);
				?>
			</div>
		</div>
		<div class="col-md-8 company-list-right">
			<div class="location-form">
				<div id="console" class="alert-danger"></div>
					<div class="row">
						<?php
							$form = $this->beginWidget('booster.widgets.TbActiveForm');
						?>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div id="sub_region" style="display: none;">
								<?= $form->select2Group($geoForm, 'sub_region_id', [
									'labelOptions' => [
										'label' => false
									],
									'wrapperHtmlOptions' => [
									],
									'widgetOptions' => [
										'data' => CHtml::listData(SubRegion::model()->findAll(), 'id', 'name'),
										'htmlOptions' => [
											'empty' => 'None',
										]
									]
								]); ?>
							</div>
							<div class="search-wide-wrap">
								<div class="search-block">
									<form action="/" method='get'>
										<label for="search-input">
											<?= CHtml::searchField('q', Yii::app()->request->getQuery('q'), ['placeholder' => 'Search for a Wedding Supplier/Business here...']); ?>
											<label for="wide-search-submit"><i class="fa fa-search" aria-hidden="true"></i></label>
											<input class="search-submit" id="wide-search-submit" type="submit">
										</label>
										<?= CHtml::radioButtonList('t',
											Yii::app()->request->getQuery('t', 0),
											Category::$searchType,
											[
												'separator' => '',
												'baseID' => 't2'
											]
										); ?>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="submit-location">
								<label for="wide-search-submit">Search</label>
								<?php 
									echo CHtml::submitButton('START');
										$this->widget(
											'booster.widgets.TbButton',
												[
													'buttonType' => 'button',
													'label' => 'GEO',
													'id' => 'bGeo'
												]
										);
									$this->endWidget();
								?>
							</div>
						</div>
					</div>
				</div>
				<script>
					window.location.hash = 'category-anchor';
				</script>
				<?php $this->widget('booster.widgets.TbListView', array(
					'dataProvider' => $dataProvider,
					'itemView' => $itemView,
					'ajaxUpdate' => false,
					'template' => '{items} {pager}',
					'emptyText' => '',
					'itemsCssClass' => '',
					'htmlOptions' => [
						'class' => ''
					],
					'pager' => [
						'maxButtonCount' => 5,
						'class' => 'booster.widgets.TbPager',
					]
				)); ?>
			</div>
		</div>
	</div>
</div>

<script>
    var country_id = '<?= $geoForm->country_id ?>';
    var region_id = '<?= $geoForm->region_id ?>';
</script>
