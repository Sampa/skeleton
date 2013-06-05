	<h6> With link <h6>
			<ul class="subWrapper">				
				<li class="dropdown" id="menu1">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#menu1"> Dropdown<b class="caret"></b></a> 
					<ul class="dropdown-menu">
						<li><a href="#">Action</a></li>
						<li class="subdropSet">
							<a href="#">Separated link</a>
							<ul class="dropdown-menu">
								<li><a href="#">Sub Menu</a></li>
								<li><a href="#">Sub Menu</a></li> 
							</ul>		 
						</li>	 
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>		 
						<li class="divider"></li>		 
					</ul>	 
				</li> 
			</ul>
			<h6>...or image</h6>
			<ul class="subWrapper">
				<li class="dropdown" id="menu1">
				<img class="dropdown-toggle" data-toggle="dropdown" src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-prn1/41682_522637332_546534390_q.jpg" href="#menu1"/>  
					<ul class="dropdown-menu">
						<li><a href="#">Action</a></li>
						<li class="subdropSet">
							<a href="#">Separated link</a>
							<ul class="dropdown-menu">
								<li><a href="#">Sub Menu</a></li>
								<li><a href="#">Sub Menu</a></li> 
							</ul>		 
						</li>	 
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>		 
						<li class="divider"></li>		 
					</ul>	 
				</li> 
			</ul>
		<?php 
	$htmlCode = '&lt;ul class="subWrapper">
	&lt;li class="dropdown" id="menu1">
	&lt;a class="dropdown-toggle" data-toggle="dropdown" href="#menu1"> Dropdown&lt;b class="caret">&lt;/b>&lt;/a> 
		&lt;ul class="dropdown-menu">
			&lt;li>&lt;a href="#">Action&lt;/a>&lt;/li>
			&lt;li class="subdropSet">
				&lt;a href="#">Separated link&lt;/a>
				&lt;ul class="dropdown-menu">
					&lt;li>&lt;a href="#">Sub Menu&lt;/a>&lt;/li>
					&lt;li>&lt;a href="#">Sub Menu&lt;/a>&lt;/li> 
				&lt;/ul>		 
			&lt;/li>	 
			&lt;li>&lt;a href="#">Another action&lt;/a>&lt;/li>
			&lt;li>&lt;a href="#">Something else here&lt;/a>&lt;/li>		 
			&lt;li class="divider">&lt;/li>		 
		&lt;/ul>	 
	&lt;/li> 
&lt;/ul>';
	$cssCode = 'ul.subWrapper{
		list-style: none;
	}
	.subdropSet{
		position:relative;
		top:0px; 
		width:100%;
	}
	.subdropSet:hover ul{
		display:block;
		position:absolute;
		left:100%;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
	}
	/*
		Level two - The unordered list inside the sub drop set 
	*/
	.subdropSet ul{
		display:none;
		list-style: none;
		margin:0px;
		top:-6px;
		border-top: 2px solid transparent;
		border-bottom: 2px solid transparent;
		border-right:0px solid white;
		-webkit-border-radius: 6px;
		-moz-border-radius: 6px;
	 	border-radius: 6px;

	}
	/*
		Level two - each container menu-alternativ
	*/
	.subdrop li{
		position:relative;
		left:0px;
		top:0px;
		padding:0px;
		margin:0px;
		border:0px solid #000;
		width:90%;
		-webkit-border-radius: 2px;
		-moz-border-radius: 2px;
		border-radius: 2px;
	}
	/*
		Same as above but hover
	*/
	.subdrop li:HOVER{
		display: inline-block;
		border-top: 0px solid transparent;
		border-bottom: 0px solid transparent;
		border-right:0px solid white;
	}
	/*
		The link itself inside the parent  .subdrop li container 
	*/
	.subdrop a {
		top:-5px;
		width:83%;
		left:0px;
	}';
	?>
			<div class="btn-group">
				<button class="bOpen btn btn-primary" data-target="boothtml1" data-buttons="bclose"> Html markup </button>>
				<button class="bOpen btn btn-primary" data-target="bootcss1" data-buttons="bclose"> Css </button>
			</div>
			<div id="boothtml1">
				<?php $this->widget('ext.sprism.sprism',array('content'=>$htmlCode,'lang'=>'php')); ?>	
			</div>
			<div id="bootcss1">
				<?php $this->widget('ext.sprism.sprism',array('content'=>$cssCode,'lang'=>'css','lines'=>array('start'=>1,'end'=>60)));	?>
			</div>