<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>crud-app</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/bootstrap.css">
</head>
<body>
    <?= $this->include('navbar')?>
    <?= $this->renderSection('content')?>
<script type="text/javascript" src="<?= base_url() ?>public/js/bootstrap.js"></script>
<script type="text/javascript" src="<?= base_url() ?>public/js/popper.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>public/js/jquery.js"></script>

<?= $this->renderSection('scripts')?>
</body>
</html>