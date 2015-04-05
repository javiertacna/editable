
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <title>Ajax Table Inline Edit</title>
  <script>
	 // Column names must be identical to the actual column names in the database, if you dont want to reveal the column names, you can map them with the different names at the server side.
	 var columns = new Array("fname","lname","tech","email","address");
	 var placeholder = new Array("Enter First Name","Enter Last Name","Enter Technology","Enter Email","");
	 var inputType = new Array("text","text","text","text","select");
	 var table = "tableDemo";
	 var selectOpt = new Array("Pune","Karad","Kolhapur","Satara","Sangli");


	 // Set button class names
	 var savebutton = "ajaxSave";
	 var deletebutton = "ajaxDelete";
	 var editbutton = "ajaxEdit";
	 var updatebutton = "ajaxUpdate";
	 var cancelbutton = "cancel";

	 var saveImage = "public/images/save.png"
	 var editImage = "public/images/edit.png"
	 var deleteImage = "public/images/remove.png"
	 var cancelImage = "public/images/back.png"
	 var updateImage = "public/images/save.png"

	 // Set highlight animation delay (higher the value longer will be the animation)
	 var saveAnimationDelay = 3000;
	 var deleteAnimationDelay = 1000;

	 // 2 effects available available 1) slide 2) flash
	 var effect = "flash";

  </script>
  <script src="public/js/jquery-1.11.0.min.js"></script>
  <script src="public/js/jquery-ui.js"></script>
  <script src="public/js/script.js"></script>
  <link rel="stylesheet" href="public/css/style.css">
 </head>
 <body>
	<table border="0" class="tableDemo bordered">
		<tr class="ajaxTitle">
			<th width="2%">Sr</th>
			<th width="16%">First Name</th>
			<th width="16%">Last Name</th>
			<th width="12%">Technology</th>
			<th width="20%">Email</th>
			<th width="18%">Address</th>
			<th width="14%">Action</th>
		</tr>
		<?php
		if(count($usuarios)){
		 $i = 1;
		 foreach ($usuarios->result() as $row) {
		?>
		<tr id="<?php echo $row->id;?>">
			<td><?php echo $i++;?></td>
			<td class="fname"><?php echo $row->fname;?></td>
			<td class="lname"><?php echo $row->lname;?></td>
			<td class="tech"><?php echo $row->tech;?></td>
			<td class="email"><?php echo $row->email;?></td>
			<td class="address"><?php echo $row->address;?></td>
			<td>
				<a id="<?php echo $row->id;?>" class="ajaxEdit"><img src="" class="eimage"></a>
				<a href="javascript:;" id="<?php echo $row->id;?>" class="ajaxDelete"><img src="" class="dimage"></a>
			</td>
		</tr>
		<?php }
		}
		?>
	</table>
 </body>
</html>
