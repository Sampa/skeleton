<div class="span8"  style="min-height:480px;">
	<h3> sPrism </h3>
	<p>
		Provides a simple way to use <a href="http://prismjs.com/">Prism</a> as a yii widget.
		<br/>Please use the link above for details	<br/>
	</p>

	<h5>Features</h5>
	<ul>
		<li>Provides syntax highlighting for code blocks thrue Prism</li>
		<li>Available languages: <em>css,javascript,php,clike,java,sql</em></li>
		<li>Extend languages easily</li>
		<li>Highlights embedded languages (e.g. CSS inside HTML, JavaScript inside HTML)</li>
		<li>Highlights inline code as well, not just code blocks</li>
		<li>Highlights nested languages (CSS in HTML, JavaScript in HTML</li>
		<li>Php & Line highlight plugins included</li>		
		<li>Bonus: Options to give a range of lines to highlight</li>

	</ul>

	<h3>Examples</h3>
		<h5> Default values </h5>
		<?php
			$code ="\$this->widget('ext.sprism.sprism',array('content'=>\$code,'lines'=>\"\",'lang'=>'php'));";
			$this->widget('ext.sprism.sprism',array('content'=>$code));
		?>
		<h5>Highlight a range of rows</h5>
		If each is false it will only highlight odd lines(1,3,5 and so on) within the start/end range.
		<?php
			$code ="\$this->widget('ext.sprism.sprism',
				array('content'=>\$code,'lines'=>array('start'=>1,'end'=>5,'each'=>true)));";
			$this->widget('ext.sprism.sprism',array('content'=>$code,'lines'=>array('start'=>1,'end'=>2,'each'=>true)));
		?>
		<h5>Optional highlighting thrue prism value</h5>		
    	<h6>Lines 1 through 2, line 5, lines 9 through 12</h6>
		<?php
			$code ="\$this->widget('ext.sprism.sprism',array('content'=>\$code,'lines'=>'1-2, 5, 9-12'));
			/*
				Foo
				Foo
				Foo
				Foo
				Foo
				Foo
				Foo
				Foo
				Foo
				Foo
			*/
			";
			$this->widget('ext.sprism.sprism',array('content'=>$code,'lines'=>'1-2, 5, 9-12'));
		?>

</div>	