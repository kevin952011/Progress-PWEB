<?php
	session_start();
	echo "<script>console.log('" . $_SESSION['tipe'] . "')</script>";
	if($_SESSION['tipe'] != "admin") {
		header("location:../login.php");
	}

	if(isset($_POST['logout-btn'])) {
		session_destroy();
		header("location:../login.php");
	}

	require 'list_function.php';
	$con = koneksi();
	echo "<script>console.log('Connected to DB!')</script>";

	if(isset($_POST['delete-book-button'])) {
		$test = count($_POST['deletion-isbn']);
		echo "<script>console.log('$test')</script>";
		foreach($_POST['deletion-isbn'] as $val) {
			query_book("DELETE FROM inventory WHERE isbn = '$val'");
		}
	}
	if(isset($_POST['insert-book-button'])) {
		$isbn = $_POST['ins-isbn'];
		$judul = $_POST['ins-judul'];
		$harga = $_POST['ins-harga'];
		$stok = $_POST['ins-stok'];
		$pic = $_POST['ins-pic'];
		query_book("INSERT INTO inventory VALUES('$isbn', '$judul', $harga, $stok, 'dum-img/$pic')");
	}

	$data_buku = retrive_query("SELECT * FROM inventory");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600,700,800" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.php">

	<title>
		MAIN--
	</title>
</head>
<body>
	<div id="dom-connection" style="display: none;">
		<form method="POST" action="" id="form-con" style="display: none;">
			<button name="logout-btn" id="logout-akun-btn" style="display: none;"></button>
		</form>
		<form method="POST" action="" id="form-con-delete">
			<button name="delete-book-button" id="dom-delete-button"></button>
		</form>
		<form method="POST" action="" id="form-retrive-data-by-dom">
			<input type="text" name="isbn-for-update" id="isbn-update">
			<button name="dom-data-retrive" id="retrive-data-by-dom"></button>
		</form>
	</div>
	<div id="main-container">
		<div id="nav-open" onclick="open_nav()">
			<img src="dum-img/menu.png">
		</div>
		<div id="nav-container">
			<div id="nav-close" onclick="close_nav()">
				<img id="nav-close-btn" src="dum-img/left_arrow.png">
			</div>
			<div id="nav-user">
				<div id="profile-pic">
					<img src="dum-img/user.png">
				</div>
				<div id="profile-desc">
					<span>
						Selamat Datang,
					</span>
					<span>
						<?= $_SESSION['user']; ?> <a onclick="logout_akun()" href="#">Logout!</a>
					</span>
				</div>
			</div>
			<div id="nav-content">
				<div class="nav-inner-content">
					<span class="nav-inner" onclick="nav_inner_click(this)"><h3>ADD MORE BOOK</h3></span>
					<span><img src="dum-img/right_arrow.png"></span>
				</div>
				<div id="form-add-book" class="expand-nav-inner">
					<form method="POST" action="">
						<span>
							<p>ISBN :</p>
							<input type="text" name="ins-isbn">
						</span>
						<span>
							<p>JUDUL :</p>
							<input type="text" name="ins-judul">
						</span>
						<span>
							<p>HARGA :</p>
							<input type="text" name="ins-harga">
						</span>
						<span>
							<p>STOK :</p>
							<input type="text" name="ins-stok">
						</span>
						<span>
							<p>PICTURE :</p>
							<input type="file" name="ins-pic" id="file-input">
						</span>
						<div id="form-add-book-btn">
							<button>Cancel</button>
							<button name="insert-book-button">Save</button>
						</div>
					</form>
				</div>
				<div class="nav-inner-content">
					<span class="nav-inner" onclick="nav_inner_click(this)"><h3>DELETE BOOK</h3></span>
					<span><img src="dum-img/right_arrow.png"></span>
				</div>
				<div id="form-delete-book" class="expand-nav-inner">
					<span><h3 style="margin: 10px 0px 0px 0px;">Data to be Deleted : </h3></span>
					<span>
						<ul id="delete-ul">
							
						</ul>
					</span>
					<div id="delete-button-wrapper">
						<button class="general-btn" onclick="create_dom_delete_data()">DELETE</button>
					</div>
				</div>
				<div class="nav-inner-content">
					<span class="nav-inner" onclick="nav_inner_click(this)"><h3>UPDATE BOOK</h3></span>
					<span><img src="dum-img/right_arrow.png"></span>
				</div>
				<div class="expand-nav-inner">
					<form method="POST">
						<span>
							<p>ISBN :</p>
							<input type="text" name="update-book" class="update-book-inp">
						</span>
						<span>
							<p>JUDUL :</p>
							<input type="text" name="update-book" class="update-book-inp">
						</span>
						<span>
							<p>HARGA :</p>
							<input type="text" name="update-book" class="update-book-inp">
						</span>
						<span>
							<p>STOK :</p>
							<input type="text" name="update-book" class="update-book-inp">
						</span>
						<span>
							<p>PICTURE :</p>
							<input type="file" name="update-book" class="update-book-inp">
						</span>
						<div id="form-add-book-btn">
							<button>Cancel</button>
							<button>Update</button>
						</div>
					</form>
				</div>
				<div class="nav-inner-content">
					<span class="nav-inner" onclick="nav_inner_click(this)"><h3>COMMIT ALL CHANGES</h3></span>
					<span><img src="dum-img/right_arrow.png"></span>
				</div>
				<div class="expand-nav-inner">
					<span>
						TESTING
					</span>
					<span>
						TESTING
					</span>
					<span>
						TESTING
					</span>
					<span>
						TESTING
					</span>
				</div>
			</div>
			<div id="nav-cart">
				<div id="cart-content-wrapper">
					
				</div>
				<div id="cart-total-wrapper">
					<div id="cart-header">
						<h3>Cart Disabled (Admin Mode)</h3>
					</div>
					<div class="cart-jumlah-item">
						<span>
							<span>ISBN :</span>
							<input id="jumlah-item-isbn" type="text" name="" disabled>
						</span>
						<span>
							<span>Jumlah Item :</span>
							<img src="">
							<input id="jumlah-item-input" type="text" name="">
							<img src="">
						</span>
					</div>
					<div class="cart-total-btn">
						<button id="check-out-btn">Check Out</button>
						<button>Cancel</button>
					</div>
					<div class="cart-total-inner">
						<span>TOTAL :Rp.</span>
						<span><input id="total-harga" type="text" name="" style="" value="-"></span>
					</div>
				</div>
			</div>
		</div>
		<div id="menu-container">
			<div id="menu-header">
				<div class="menu-header-wrapper">
					<h1>Explore</h1>
				</div>
				<div class="menu-header-wrapper">
					<img src="dum-img/search.png">
					<input id="menu-search-input" type="text" name="" placeholder="Explore the Books!">
				</div>
			</div>
			<div id="menu-books">
				 <div id="menu-books-header">
				 	<h1>Collection of Books!</h1>
				 </div>
				 <div id="menu-books-content-wrapper">
				 	
				 		<?php $i = 1; foreach($data_buku as $buku):?>

				 	<div id="book-<?= $buku['isbn']; ?>" class="book-content" onmouseenter="book_hover(this.children[0])" onmouseleave="book_unhover(this.children[0])">
				 		<div class="book-hover">
					 		<span class="update-data" onclick="add_update_data(this)"><p>Update Book</p></span>
					 		<span class="delete-data" onclick="add_deleting_data(this)"><p>Delete Book</p></span>
					 	</div>
				 		<div class="book-image">
				 			<img src="<?= $buku['image']; ?>">
				 		</div>
				 		<div class="book-desc">
				 			<p><?= $buku['judul']; ?></p>
				 			<p style="font-weight: 600;">Rp. <?= $buku['harga']; ?></p>
				 		</div>
				 	</div>
				 	
				 	<?php endforeach;?>

				 </div>
			</div>
		</div>
	</div>

		<script type="text/javascript">
			function book_hover(elem) {
				elem.style.cssText = 'opacity: 1;';
			}

			function book_unhover(elem) {
				elem.style.cssText = 'opacity: 0;';
			}

			window.addEventListener('resize', function() {
				if(window.innerWidth > 1199 ) {
					document.getElementById('nav-container').style.cssText = '';
				}
			});

			function open_nav() {
				document.getElementById('nav-container').style.cssText = 'width: 370px;';
			}
			function close_nav() {
				document.getElementById('nav-container').style.cssText = 'width = 0px;';
			}

			function nav_inner_click(elem) {
				target_elem = elem.parentElement.nextElementSibling;

				if(document.querySelector('.expand-nav-inner-open')) {
					if(document.querySelector('.expand-nav-inner-open').id === target_elem.id) {
						document.querySelector('.expand-nav-inner-open').classList.remove('expand-nav-inner-open');
						return '';
					}
					document.querySelector('.expand-nav-inner-open').classList.remove('expand-nav-inner-open');
				}

				target_elem.classList.add('expand-nav-inner-open');

			}

			function add_update_data(elem) {
				target_isbn = elem.parentElement.parentElement.id.slice(5);
				document.getElementById('isbn-update').value = target_isbn;

				document.getElementById('retrive-data-by-dom').click();

			}

			data_deletion = [];
			data_update = [];

			function add_deleting_data(elem) {
				target_isbn = elem.parentElement.parentElement.id.slice(5);
				
				if(data_deletion.includes(target_isbn)) {
					alert('duplicate');
					return '';
				} else {
					data_deletion.push(target_isbn);
				}

				elem.parentElement.parentElement.classList.add('selected_deletion');
				
				if(document.querySelector('.expand-nav-inner-open')) {
					if(document.querySelector('.expand-nav-inner-open').id === 'form-delete-book') {
						//nothing
					} else {
						document.querySelector('.expand-nav-inner-open').classList.remove('expand-nav-inner-open');
						document.getElementById('form-delete-book').classList.add('expand-nav-inner-open');
					}
				} else {
					document.getElementById('form-delete-book').classList.add('expand-nav-inner-open');
				}

				deletion_display();

			}

			function create_dom_delete_data() {
				if(data_deletion.length === 0) {
					alert('No data to be delete!');
					return '';
				}
				parent = document.getElementById('form-con-delete');
				for(var x in data_deletion) {
					input = document.createElement('INPUT');
					input.setAttribute('type', 'text');
					input.name = 'deletion-isbn[]';
					input.value = data_deletion[x];
					parent.appendChild(input);
				}
				document.getElementById('dom-delete-button').click();
			}

			function deletion_display() {
				parent = document.getElementById('delete-ul');
				parent.innerHTML = ``;
				for (var x in data_deletion) {
					li = document.createElement('li');
					li.innerHTML = `
						<span style="width: 100%; display: flex; flex-flow: row; justify-content: space-between;">
						<p style="margin: 0px;">`+data_deletion[x]+`</p> 
						<img src="dum-img/close.png" style="width: 25px; height: 25px;" onclick="revert_deletion(this)">
						</span>
					`;
					li.setAttribute('onmouseenter', 'deletion_onhover(this)');
					li.setAttribute('onmouseleave', 'deletion_unhover(this)');
					parent.appendChild(li);
				}
			}

			function revert_deletion(elem) {
				console.log(elem.previousElementSibling.innerHTML);
				id = elem.previousElementSibling.innerHTML;
				id_elem = 'book-'+elem.previousElementSibling.innerHTML;
				document.querySelector('#'+id_elem).className = 'book-content';

				delete_from_arr(id, data_deletion);
				deletion_display();
			}
			function delete_from_arr(id, arr) {
				for(var x in arr) {
					if(arr[x] === id) {
						arr.splice(x, 1);
						x = arr.length;
					}
				}
			}

			function deletion_onhover(elem) {
				id = elem.children[0].childNodes[1].innerHTML;

				target_elem = document.querySelector('#book-'+id);
				target_elem.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
				target_elem.classList.add('hover_deletion');
				target_elem.classList.remove('selected_deletion');
			}

			function deletion_unhover(elem) {
				id = elem.children[0].childNodes[1].innerHTML;

				target_elem = document.querySelector('#book-'+id);
				target_elem.classList.remove('hover_deletion');
				target_elem.classList.add('selected_deletion');
			}

			function logout_akun() {
				let tx = 'Logging Out?';
				if(confirm(tx) == true) {
					document.getElementById('logout-akun-btn').click();
				} else {
					//
				}
				
			}
		</script>
</body>
</html>

<?php 
	if(isset($_POST['dom-data-retrive'])) {
		$isbn = $_POST['isbn-for-update'];
		$data_update = retrive_query("SELECT * FROM inventory WHERE isbn = '$isbn'");
		foreach($data_update as $val) {
			echo "<script>
			dom_target = document.getElementsByClassName('update-book-inp');
			dom_target[0].parentElement.parentElement.parentElement.classList.add('expand-nav-inner-open');
			dom_target.add
			dom_target[0].value = '". $val['isbn'] ."';
			dom_target[1].value = '". $val['judul'] ."';
			dom_target[2].value = '". $val['harga'] ."';
			dom_target[3].value = '". $val['stok'] ."';
			</script>";
		}
	}
?>