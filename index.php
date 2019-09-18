<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, user-scalable=no">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>List-A</title>
	<link rel="shortcut icon" href="img/icon1.png" >
	<meta name=      "mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<!-- Mis estilos -->
	<link rel="stylesheet" type="text/css" href="css/style.css?v=3">







	<!-- TEMPLATES -->
	<template id="listElement">
		<div class="element" onclick="box.selectElement(this.id)" onfocusout="if(box.slct[0]){box.slct[0].sendEdit()}" tabindex="1">
			<div class="eColor"></div>
			<p  class="eTxt" contenteditable="false"></p>
			<button class="eNavigate">
				<div id="eNavigateDash1" class="eNavigateDash"></div>
				<div id="eNavigateDash2" class="eNavigateDash"></div>
			</button>
		</div>
	</template>

	<template id="favsElement">
		<div class="mainMenuElement" tabindex="1">
			<div class="eColor"></div>
			<p class="eTxt"></p>
			<p class="eNmr"></p>
		</div>
	</template>

	<template id="frndElement">
		<li class="friendListElement">
			<input class="friendListInput" type="checkbox" id="" name="" value="">
			<label for="" class="frndClr">
				<p class="frndTxt"></p>
			</label>
		</li>
	</template>

	<template id="cancelTemp">
		<div id="cancel" onclick="box.cancel()" tabindex="0">
			<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
				<path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path>
			</svg>
		</div>
	</template>








</head>
<body class="">






	<view id="load" class="load">
			<div class="circle"></div>
	</view>









	<view id="login">
		<h1>list<br><span id="titleA">A</span></h1>
		<div id="blockView"></div>
		<form id="signForm" action="">
			<input class="signInput" id="signInputNick" name="uid" type="text"     placeholder="Nick name*"       tabindex= "1">
			<p     class="errorMsg"  id="nickEmpty">can't be empty</p>
			<input class="signInput" id="signInputPass" name="pwd" type="password" placeholder="Password*"        tabindex= "1">
			<p     class="errorMsg"  id="passEmpty">can't be empty</p>
			<input class="signInput" id="signInputPas2" name="pw2" type="password" placeholder="Repeat password*" tabindex="-1">
			<p     class="errorMsg"  id="passMatch">not a match</p>
			<input class="signInput" id="signInputMail" name="eml" type="text"     placeholder="E-mail*"          tabindex="-1">
			<p     class="errorMsg"  id="mailEmpty">can't be empty</p>
			<p     class="errorMsg"  id="mailInvld">invalid mail</p>
			<p     class="errorMsg"  id="mailTaken">mail is taken</p>
			<input class="signInput" id="signInputName" name="fst" type="text"     placeholder="First name"       tabindex="-1">
			<input class="signInput" id="signInputLast" name="lst" type="text"     placeholder="Last name"        tabindex="-1">
			<p>
				By registering to our site you accept the still unexisting
				<span>privacy policy</span> and <span>data handling.</span>
			</p>
		</form>

		<button id="signUpBtn" class="signBtn" onclick="box.signUp()">sign up</button>
		<button id="signInBtn" class="signBtn" onclick="box.signIn(d.getElementById('signInputNick').value,d.getElementById('signInputPass').value)">sign in</button>
	</view>















	<view class="main">
		<nav id="navBar">
			<button id="mainMenuButton">
				<div class="menuBar"></div>
				<div class="menuBar"></div>
				<div class="menuBar"></div>
			</button>

			<menu id="mainMenu">
				<!-- TODO: account -->
				<figure id="mainMenuProfile" onclick="box.loadElements(box.base)">
					<!-- <img src="img/15063.jpg" id="mainMenuProfilePic"> -->
					<svg id="mainMenuProfilePic" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path></svg>
					<figcaption id="mainMenuProfileCaption">
						<h3 id="userName"></h3>
						<p id="userKey"></p>
					</figcaption>
				</figure>

				<!-- TODO: aqui todos tendrian que ser hijos de favorites -->
				<div tabindex="1" class="mainMenuElement selected" onclick="box.loadElements(home)">
					<p class="mainMenuElementName">home</p>
					<p class="eNmr" id="homeNmr"></p>
				</div>
				<div tabindex="1" class="mainMenuElement" onclick="box.loadElements(tday)">
					<p class="mainMenuElementName">today</p>
					<p class="eNmr" id="tdayNmr"></p>
				</div>
				<div id="favsCont"></div>

				<div tabindex="1" class="mainMenuElement" onclick="box.loadElements(grps)">
					<p class="mainMenuElementName">groups</p>
					<p class="eNmr" id="grpsNmr"></p>
				</div>

				<div tabindex="1" class="mainMenuElement" onclick="box.loadElements(frnd)">
					<p class="mainMenuElementName">friends</p>
					<p class="eNmr" id="frndNmr"></p>
				</div>

	<!-- TODO: Tags
				<div tabindex="1" class="mainMenuElement">
					<p class="mainMenuElementName">Tags</p>
					<p class="mainMenuElementNumber">9</p>
				</div>
	-->
	<!-- TODO: Config
				<div tabindex="1" class="mainMenuElement">
					<p class="mainMenuElementName">Config</p>
					<p class="mainMenuElementNumber"></p>
				</div>
	-->
				<div tabindex="1" class="mainMenuElement" style="margin-top: auto;" onclick="box.signOut()">
					<p class="mainMenuElementName">Logout</p>
					<p class="mainMenuElementNumber"></p>
				</div>
			</menu>

			<h2 id="title"></h2>

			<button id="elementMenu">
				<div class="menuDot"></div>
				<div class="menuDot"></div>
				<div class="menuDot"></div>
			</button>

			<menu id="secdMenu">
				<div id="secdMenuTitle">Options</div>
				<div class="secdMenuElement"><button class="secdMenuButton" onclick="box.slct[box.slct.length - 1].editTxt()">Edit</button></div>

				<button for="amrSM" class="colrOption" onclick="box.slct.forEach(function(v){v.editColr(1)})"><span id="amrCirc" class="checkmark"></span><p class="colrOptP">Bolt  </p></button>
				<button for="rojSM" class="colrOption" onclick="box.slct.forEach(function(v){v.editColr(2)})"><span id="rojCirc" class="checkmark"></span><p class="colrOptP">Fire  </p></button>
				<button for="verSM" class="colrOption" onclick="box.slct.forEach(function(v){v.editColr(3)})"><span id="verCirc" class="checkmark"></span><p class="colrOptP">Gold  </p></button>
				<button for="azlSM" class="colrOption" onclick="box.slct.forEach(function(v){v.editColr(4)})"><span id="azlCirc" class="checkmark"></span><p class="colrOptP">Marine</p></button>
				<button for="blcSM" class="colrOption" onclick="box.slct.forEach(function(v){v.editColr(5)})"><span id="blcCirc" class="checkmark"></span><p class="colrOptP">Void  </p></button>
				<button for="njaSM" class="colrOption" onclick="box.slct.forEach(function(v){v.editColr(6)})"><span id="njaCirc" class="checkmark"></span><p class="colrOptP">Ninja </p></button>

				<div class="secdMenuElement"><button class="secdMenuButton" onclick="box.slct.forEach(function(v){v.altParent(v.favorite,1)});box.cancel()">Favorite</button></div>
				<div class="secdMenuElement"><button class="secdMenuButton" onclick="box.slct.forEach(function(v){v.editElement('arc',1 ,1)});box.cancel()">Archive </button></div>
				<div class="secdMenuElement"><button class="secdMenuButton" onclick="box.slct.forEach(function(v){v.editElement('del',1 ,1)});box.cancel()">Delete  </button></div>
			</menu>
		</nav>

		<section id="list">
			<!-- ------  Get involved and Point someone in the right direction  ------ -->
		</section>

		<button id="backButton" onclick="box.loadElements(box.hist[1],1)">
			<div class="backButtonBar" id="backButtonBar2"></div>
			<div class="backButtonBar" id="backButtonBar1"></div>
		</button>

		<!-- TODO: hacer que todos los botones sean el mismo que se transforman uno en otro -->

		<!-- <button id="button2" class="btnRound buttonTwo" onclick="box.buttons[2]()" tabindex="0">
			<div class="buttonTwoCircle" id=""></div>
			<div class="buttonTwoCircle" id=""></div>
		</button> -->

		<button id="button1" class="btnRound buttonOne" onclick="box.buttons[1]()" tabindex="0">
			<div class="buttonOneCircle" id=""></div>
		</button>

		<button id="button0" class="btnRound buttonZero" onclick="box.buttons[0]()" tabindex="0">
			<div class="mainButtonBar" id="mainButtonBar1"></div>
			<div class="mainButtonBar" id="mainButtonBar2"></div>
		</button>




		<form id="addNew" action="" onkeypress="return event.keyCode != 13;">
			<input id="addNewText" type="text" placeholder="Write" autocomplete="off">

			<span class="addNewButton" id="addNewFrnd">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path></svg>
				<input class="addNewFrndInput" type="number" name="friendId" value="">
			</span>

			<span class="addNewButton" id="addNewDate">
				<svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 64h-48V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H160V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zm-6 400H54c-3.3 0-6-2.7-6-6V160h352v298c0 3.3-2.7 6-6 6z"></path></svg>

				<div class="" id="datePicker">
					<input type="date" id="dateInput">
				</div>
			</span>

			<span class="addNewButton" id="addNewPrty">
				<svg aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M349.565 98.783C295.978 98.783 251.721 64 184.348 64c-24.955 0-47.309 4.384-68.045 12.013a55.947 55.947 0 0 0 3.586-23.562C118.117 24.015 94.806 1.206 66.338.048 34.345-1.254 8 24.296 8 56c0 19.026 9.497 35.825 24 45.945V488c0 13.255 10.745 24 24 24h16c13.255 0 24-10.745 24-24v-94.4c28.311-12.064 63.582-22.122 114.435-22.122 53.588 0 97.844 34.783 165.217 34.783 48.169 0 86.667-16.294 122.505-40.858C506.84 359.452 512 349.571 512 339.045v-243.1c0-23.393-24.269-38.87-45.485-29.016-34.338 15.948-76.454 31.854-116.95 31.854z"></path></svg>
			</span>

			<div id="addNewColr">
				<label for="ver" class="colrOption"><input type="radio" name="colr" id="ver" class="colrOpt" onclick="box.selectColor(this.value)" value="1"        ><span id="amrCirc" class="checkmark"></span><p class="colrOptP">Bolt  </p></label>
				<label for="roj" class="colrOption"><input type="radio" name="colr" id="roj" class="colrOpt" onclick="box.selectColor(this.value)" value="2"        ><span id="rojCirc" class="checkmark"></span><p class="colrOptP">Fire  </p></label>
				<label for="amr" class="colrOption"><input type="radio" name="colr" id="amr" class="colrOpt" onclick="box.selectColor(this.value)" value="3"        ><span id="verCirc" class="checkmark"></span><p class="colrOptP">Gold  </p></label>
				<label for="azl" class="colrOption"><input type="radio" name="colr" id="azl" class="colrOpt" onclick="box.selectColor(this.value)" value="4"        ><span id="azlCirc" class="checkmark"></span><p class="colrOptP">Marine</p></label>
				<label for="blc" class="colrOption"><input type="radio" name="colr" id="blc" class="colrOpt" onclick="box.selectColor(this.value)" value="5" checked><span id="blcCirc" class="checkmark"></span><p class="colrOptP">Void  </p></label>
				<label for="nja" class="colrOption"><input type="radio" name="colr" id="nja" class="colrOpt" onclick="box.selectColor(this.value)" value="6"        ><span id="njaCirc" class="checkmark"></span><p class="colrOptP">Ninja </p></label>
			</div>

			<span class="addNewButton" id="addNewSend" onclick="
				var inputs=d.getElementById('addNew').elements;
				box.addNewElement(
					inputs['addNewText'].value,
					inputs['colr'].value,
					inputs['dateInput'].value,
					inputs['friendId'].value,
					box.hist[0].bse,
					box.hist[0].epk,
					'',
				);
			">
			<!-- <span class="addNewButton" id="addNewSend" onclick="
				var inputs=d.getElementById('addNew').elements;c.log(inputs);
			"> -->
				<svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg>
			</span>
		</form>
	</view>

















		<view class="newGroup">
			<h2 class="newGroupTitle">New Group</h2>
			<input id="newGroupName" type="text" name="" value="" placeholder="Name of group">
			<h4>+ friends</h4>
			<ul class="newGroupFriendList">
			</ul>
			<input class="button" type="button" name="" value="Cancel" onclick="box.selectView('bMain')">
			<input class="button" type="button" name="" value="Create" onclick="box.createGroup()">
		</view>












	<script type="text/javascript" src="js/custom.js?v=3"></script>
</body>
</html>
