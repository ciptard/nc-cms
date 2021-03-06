<?php  if (!defined('NC_BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">	
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<title>nc-cms | HTML Editor</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<meta name="robots" content="noindex" />
		<meta name="robots" content="nofollow" />
		<link rel="stylesheet" type="text/css" media="screen" href="system/css/editor.css"/>
		<link rel="stylesheet" type="text/css" media="screen" href="system/css/editor_html.css"/>
		<!--[if lt IE 7]><link rel="stylesheet" type="text/css" media="screen" href="system/css/ie.css"/><![endif]-->
		<script type="text/javascript" src="system/modules/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript">	
			tinyMCE.init({
				mode : "textareas",
				theme : "advanced",
				skin : "default",
				relative_urls : 0,
				
				plugins : "safari,table,advimage,advlink,inlinepopups,insertdatetime,media,searchreplace,paste,directionality,fullscreen,xhtmlxtras,pagebreak",

				theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,indent,outdent,sub,sup,formatselect,fontselect,fontsizeselect,forecolor,backcolor,selectall,removeformat,|,code,cleanup,fullscreen",
				theme_advanced_buttons2 : "undo,redo,paste,pastetext,pasteword,search,|,image,link,unlink,media,inserttime,insertdate,charmap,media,pagebreak,|,tablecontrols,|,visualaid",
				theme_advanced_buttons3 : "",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : true,
				theme_advanced_blockformats: "p,pre,h1,h2,h3,h4,h5",

				content_css : "css/content.css"
			});
			
			// onbeforeunload() does not work correctly in certain browsers. Disable this functionality if not using Firefox/Chrome.
			var confirmed_exit = true;
			if(!navigator.appName.indexOf("Netscape")) 
				confirmed_exit = false;
				
			window.onbeforeunload = function () 
			{	
				if(!confirmed_exit)
					return "You have not saved yet.  If you continue, your work will not be saved."
			}	
			
			function save_confirmation() 
			{
				var answer = confirm("Are you sure you want to save?\nAny changes you have made to the web page will go live.");
				if(answer)  
				{
					confirmed_exit = true;
					document.editorform.submit();
				}
			}
			function cancel_confirmation() 
			{
				var answer = confirm("Are you sure you want to cancel?\nAny changes you have made to the web page will not be saved.");
				if(answer)
				{
					confirmed_exit = true;
					this.location.href = "<?php echo $_SERVER['HTTP_REFERER']; ?>";
				}
			}
			function open_file_manager() 
			{
				window.open('index.php?action=file_manager','insert_file','width=640,height=460,screenX=200,left=200,screenY=200,top=200,status=yes,menubar=no');
			}		
		</script>
	</head>
	<body>
		<div id="wrapper">
			<div id="editor">
				<h1 title="Powered by nc-cms"><?php echo NC_WEBSITE_NAME; ?>
				</h1>
				<form name="editorform" id="editorform" method="post" action="index.php?action=save&amp;ref=<?php echo $_SERVER['HTTP_REFERER']; ?>">
					<br />
					<textarea cols="102" rows="20" name="editordata" id="editordata" class="textfield"><?php echo htmlspecialchars($data); ?></textarea>
					<input name="name" id="name" type="hidden" value="<?php echo $name; ?>" />
					<p class="tip">Remember! You can set paragraphs and headings using the Format menu.
					</p>
					<br />
					<span class="button file_man"><a href="javascript:open_file_manager()"><span class="icon icon_upload">Insert a File or Image</span></a></span>
					<br /><br />
					<br /><br />
					<span class="button"><a href="javascript:save_confirmation()"><span class="icon icon_accept">Save</span></a></span>
					<span class="button"><a href="javascript:cancel_confirmation()"><span class="icon icon_delete">Cancel</span></a></span>
				</form>
				<div class="footer"></div>
			</div>
		</div>
	</body>
</html>