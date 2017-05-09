
<link rel="stylesheet" href="assets/admin/css/compiled/user-list.css" type="text/css" media="screen" />
<!-- main container -->
<div class="content">
	<div class="container-fluid">
		<div id="pad-wrapper" class="users-list">
			<div class="row-fluid header">
				<h3>订单列表</h3></div>
			<!-- Users table -->
			<div class="row-fluid table">
				<table class="table table-hover">
					<thead>
					<tr>
						<th class="span2 sortable">
							<span class="line"></span>订单编号</th>
						<th class="span2 sortable">
							<span class="line"></span>下单人</th>
						<th class="span3 sortable">
							<span class="line"></span>收货地址</th>
						<th class="span3 sortable">
							<span class="line"></span>快递方式</th>
						<th class="span2 sortable">
							<span class="line"></span>订单总价</th>
						<th class="span3 sortable">
							<span class="line"></span>商品列表</th>
						<th class="span3 sortable">
							<span class="line"></span>订单状态</th>
						<th class="span2 sortable align-right">
							<span class="line"></span>操作</th>
					</tr>
					</thead>
					<tbody>
					<!-- row -->
					<tr class="first">
						<td>2</td>
						<td>zhangsan</td>
						<td>北京市朝阳区某某街道</td>
						<td>包邮</td>
						<td>0.01</td>
						<td>1 x
							<a href="<?php echo yii\helpers\Url::to(['order/send']); ?>">长裙</a></td>
						<td>
							<span class="label label-success">订单完成</span></td>
						<td class="align-right">
							<a href="<?php echo yii\helpers\Url::to(['order/detail']) ?>">查看</a></td>
					</tr>

					</tbody>
				</table>
			</div>
			<div class="pagination pull-right"></div>
			<!-- end users table --></div>
	</div>
</div>
<!-- end main container -->
