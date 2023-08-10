<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!--[if gte mso 9]>
  <xml>
	<o:OfficeDocumentSettings>
	  <o:AllowPNG/>
	  <o:PixelsPerInch>96</o:PixelsPerInch>
   </o:OfficeDocumentSettings>
  </xml>
  <![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="./styles.css" />
	@@include('./components/_unmergable-styles.php')
</head>

<body>
	<table cellpadding="0" cellspacing="0" border="0" id="mainTable" bgcolor="#FFFFFF" width="100%">
		<tr>
			<td class="bg-grey" valign="top">
				<br />
				<br />
				@@include('./components/_header.php')

				<table class="w100-sm" width="640" cellpadding="0" cellspacing="0" align="center">
					<tr>
						<td class="bg-white pt-3 px-2 pb-3">
							<h1>
								Hi,
								<?= $params->user ?>
							</h1>
							<p>
								<strong>
									<?= $params->message ?>
								</strong>
							</p>
							<p>
								<?= $params->submessage ?>
							</p>
							<br />
							<p>
								Thanks,
							</p>
							<p>
								The
								<?= ucwords(Yii::$app->name) ?> team
							</p>
						</td>
					</tr>
				</table>

				@@include('./components/_footer.php')

				<br />
				<br />
			</td>
		</tr>
	</table>
</body>

</html>
