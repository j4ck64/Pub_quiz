function addId(id, answer) {
	var a = answer;
	// var id = id
	// alert(id);
	$.ajax({
		type: "POST",
		// url: "http://localhost/pub_quiz/questions/q-2",
		// url: "<?php echo base_url(); ?>controllers/Questions/index()",
		url: "save",
		// data: { id: id, user_id: 1, answer: a },
		// data:{id:id},
		data:id,
		// url: location.href = href="save",
		cache: false,
		async: true,
		success: function (result) {
			console.log("sex");
		},
		error: function (e) {
			console.log("no pussy for u");
		},
	});
	alert(id);
	// window.location.href = '<?php echo base_url(); ?>controllers/Questions/q-2';
}

function addanwser(id) {
	var id = id
	// alert(id);
	$.ajax({
		type: "POST",
		// url: "http://localhost/pub_quiz/questions/q-2",
		// url: "<?php echo base_url(); ?>controllers/Questions/index()",
		url: "questions/save",
		// data: { id: id, user_id: 1, answer: a },
		data:{id:id},
		// url: location.href = href="save",
		cache: false,
		async: false,
		success: function (result) {
			console.log("sex");
		},
		error: function (e) {
			console.log("no pussy for u");
		},
	});
	alert(id);
	// window.location.href = '<?php echo base_url(); ?>controllers/Questions/q-2';
}

/*
www.jack.co.uk/api/
SELECT * FROM USER

GET www.jack.co.uk/api/user
POST www.jack.co.uk/api/user DATA



*/
