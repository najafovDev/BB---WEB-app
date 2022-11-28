<?php
/**
 * ## TbExtendedGridView class file
 *
 * @author Antonio Ramirez <antonio@clevertech.biz>
 * @copyright Copyright &copy; Clevertech 2012-
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php) 
 */

Yii::import('booster.widgets.TbExtendedGridView');

/**
 *## TbExtendedGridView is an extended version of TbGridView.
 *
 * Features are:
 *  - Display an extended summary of the records shown. The extended summary can be configured to any of the
 *  {@link TbOperation} type of widgets.
 *  - Automatic chart display (using TbHighCharts widget), where user can 'switch' between views.
 *  - Selectable cells
 *  - Sortable rows
 *
 * @property CActiveDataProvider $dataProvider the data provider for the view.
 * @property TbDataColumn[] $columns
 *
 * @package booster.widgets.grids
 */
class MfeTbExtendedGridView extends TbExtendedGridView {
	
	/**
	 * @var bool $fixedHeader if set to true will keep the header fixed  position
	 */
	public $fixedHeader = false;

	/**
	 * @var integer $headerOffset, when $fixedHeader is set to true, headerOffset will position table header top position
	 * at $headerOffset. If you are using bootstrap and has navigation top fixed, its height is 40px, so it is recommended
	 * to use $headerOffset=40;
	 */
	public $headerOffset = 0;

	/**
	 * @var string the template to be used to control the layout of various sections in the view.
	 * These tokens are recognized: {extendedSummary}, {summary}, {items} and {pager}. They will be replaced with the
	 * extended summary, summary text, the items, and the pager.
	 */
	public $template = "{summary}\n{items}\n{pager}\n{extendedSummary}";

	/**
	 * @var array $extendedSummary displays an extended summary version.
	 * There are different types of summary types,
	 * please, see {@link TbSumOperation}, {@link TbSumOfTypeOperation},{@link TbPercentOfTypeGooglePieOperation}
	 * {@link TbPercentOfTypeOperation} and {@link TbPercentOfTypeEasyPieOperation}.
	 *
	 * The following is an example, please review the different types of TbOperation classes to find out more about
	 * its configuration parameters.
	 *
	 * <pre>
	 *  'extendedSummary' => array(
	 *      'title' => '',      // the extended summary title
	 *      'columns' => array( // the 'columns' that will be displayed at the extended summary
	 *          'id' => array(  // column name "id"
	 *              'class' => 'TbSumOperation', // what is the type of TbOperation we are going to display
	 *              'label' => 'Sum of Ids'     // label is name of label of the resulted value (ie Sum of Ids:)
	 *          ),
	 *          'results' => array(   // column name "results"
	 *              'class' => 'TbPercentOfTypeGooglePieOperation', // the type of TbOperation
	 *              'label' => 'How Many Of Each? ', // the label of the operation
	 *              'types' => array(               // TbPercentOfTypeGooglePieOperation "types" attributes
	 *                  '0' => array('label' => 'zeros'),   // a value of "0" will be labelled "zeros"
	 *                  '1' => array('label' => 'ones'),    // a value of "1" will be labelled "ones"
	 *                  '2' => array('label' => 'twos'))    // a value of "2" will be labelled "twos"
	 *          )
	 *      )
	 * ),
	 * </pre>
	 */
	public $extendedSummary = array();

	/**
	 * @var string $extendedSummaryCssClass is the class name of the layer containing the extended summary
	 */
	public $extendedSummaryCssClass = 'extended-summary';

	/**
	 * @var array $extendedSummaryOptions the HTML attributes of the layer containing the extended summary
	 */
	public $extendedSummaryOptions = array();

	/**
	 * @var array $componentsAfterAjaxUpdate has scripts that will be executed after components have updated.
	 * It is used internally to render scripts required for components to work correctly.  You may use it for your own
	 * scripts, just make sure it is of type array.
	 */
	public $componentsAfterAjaxUpdate = array();

	/**
	 * @var array $componentsReadyScripts hold scripts that will be executed on document ready.
	 * It is used internally to render scripts required for components to work correctly. You may use it for your own
	 * scripts, just make sure it is of type array.
	 */
	public $componentsReadyScripts = array();

	/**
	 * @var array $chartOptions if configured, the extended view will display a highcharts chart.
	 */
	public $chartOptions = array();

	/**
	 * @var bool $sortableRows. If true the rows at the table will be sortable.
	 */
	public $sortableRows = false;

	/**
	 * @var string Database field name for row sorting
	 */
	public $sortableAttribute = 'sort_order';

	/**
	 * @var boolean Save sort order by ajax defaults to false
	 * @see bootstrap.action.TbSortableAction for an easy way to use with your controller
	 */
	public $sortableAjaxSave = false;

	/**
	 * @var string Name of the action to call and sort values
	 * @see bootstrap.action.TbSortableAction for an easy way to use with your controller
	 *
	 * <pre>
	 *  'sortableAction' => 'module/controller/sortable' | 'controller/sortable'
	 * </pre>
	 *
	 * The widget will make use of the string to create the URL and then append $sortableAttribute
	 * @see $sortableAttribute
	 */
	public $sortableAction;

	/**
	 * @var string a javascript function that will be invoked after a successful sorting is done.
	 * The function signature is <code>function(id, position)</code> where 'id' refers to the ID of the model id key,
	 * 'position' the new position in the list.
	 */
	public $afterSortableUpdate;

	/**
	 * @var bool whether to allow selecting of cells
	 */
	public $selectableCells = false;

	/**
	 * @var string the filter to use to allow selection. For example, if you set the "htmlOptions" property of a column to have a
	 * "class" of "tobeselected", you could set this property as: "td.tobeselected" in order to allow  selection to
	 * those columns with that class only.
	 */
	public $selectableCellsFilter = 'td';

	/**
	 * @var string a javascript function that will be invoked after a selection is done.
	 * The function signature is <code>function(selected)</code> where 'selected' refers to the selected columns.
	 */
	public $afterSelectableCells;
	/**
	 * @var array the configuration options to display a TbBulkActions widget
	 * @see TbBulkActions widget for its configuration
	 */
	public $bulkActions = array();

	/**
	 * @var string the aligment of the bulk actions. It can be 'left' or 'right'.
	 */
	public $bulkActionAlign = 'right';

	/**
	 * @var TbBulkActions component that will display the bulk actions to the grid
	 */
	protected $bulk;

	/**
	 * @var boolean $displayExtendedSummary a helper property that is set to true if we have to render the
	 * extended summary
	 */
	protected $displayExtendedSummary;
	/**
	 * @var boolean $displayChart a helper property that is set to true if we have to render a chart.
	 */
	protected $displayChart;

	/**
	 * @var TbOperation[] $extendedSummaryTypes hold the current configured TbOperation that will process column values.
	 */
	protected $extendedSummaryTypes = array();

	/**
	 * @var array $extendedSummaryOperations hold the supported operation types
	 */
	protected $extendedSummaryOperations = array(
		'TbSumOperation',
		'TbCountOfTypeOperation',
		'TbPercentOfTypeOperation',
		'TbPercentOfTypeEasyPieOperation',
		'TbPercentOfTypeGooglePieOperation'
	);

	/**
	 *### .init()
	 *
	 * Widget initialization
	 */
	public function init(){
		parent::init();
                $str = Yii::t('system','Displaying {start} - {end} of {count}');
                $this->summaryText = CHtml::tag('div',array('class'=>'pull-left'),
                                                CHtml::tag('span',array(), 'Show ').CHtml::dropDownList('$name', 
                                                                            Yii::app()->getRequest()->getParam('pageSize',Yii::app()->params['gridViewPageSize']),
                                                                            isset(Yii::app()->params['gridViewPageSizeArray'])?Yii::app()->params['gridViewPageSizeArray']:array(20=>20,50=>50,100=>100),
                                                                            array(
                                                                                'class'=>'selectpicker input-lg',
                                                                                'onchange'=>''
                                                                                . "$.fn.yiiGridView.update($(this).parents('.grid-view').attr('id'),{ data:{pageSize: $(this).val() }})"
                                                                            )
                                                ).CHtml::tag('span',array(), 'entries '));
                $this->summaryText.= "<div class='pull-right'>{$str}</div>";
                $this->summaryText.=CHtml::tag('div',array('class'=>'clearfix'),'');
                //$this->summaryText = CHtml::tag('div',array('class'=>'mb20'),$this->summaryText);
                $this->summaryCssClass = 'summary mb10';
	}

	/**
	 *### .renderContent()
	 *
	 * Renders grid content
	 */
}
