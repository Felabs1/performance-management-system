function openModal(id) {
  $(`#${id}`).show();
}

function closeModal(id) {
  $(`#${id}`).hide();
  window.location.href = "";
}

retrieveData = (id, url) => {
  $.get(url, function (data) {
    // console.log(data);
    $(`#${id}`).html(data);
  });
};

retrieveMarksData = (id, url) => {
  $.get(url, function (data) {
    // console.log(data);
    $(`#${id}`).val(data);
  });
};

openModalInTable = (id, url) => {
  $(`#${id}`).show();
  $.get(url, function (data) {
    $(`#${id}`).html(data);
  });
};

registerStudent = () => {
  var sname, sadm, scourse;
  sname = $("#sname").val();
  sadm = $("#sadm").val();
  scourse = $("#scourse").val();

  if (sname == "" || sadm == "" || scourse == "") {
    alert("please fill in al fields");
  } else {
    $.ajax({
      url: "./resources/process.php?new_student=true",
      method: "POST",
      data: $("#frmNewStudent").serialize(),
      success: function (data) {
        if (data == "student_exists") {
          alert("the student exists");
        } else {
          sname = "";
          sadm = "";
          scourse = "";
          $("#sname").val("");
          $("#sadm").val("");
          $("#scourse").val("");
          $("#studentAlert").show();
          $("#studentAlert").fadeOut(2000);
        }
      },
    });
  }
};

newEntry = () => {
  var marks = $("#marks").val();
  if (marks == "") {
    alert("please enter marks");
  } else if (marks > 100) {
    alert("number should be less than 100");
  } else if (marks < 0) {
    alert("number should not be a negative");
  } else {
    $.ajax({
      url: "./resources/process.php?new_entry=true",
      method: "POST",
      data: $("#frmEntry").serialize(),
      success: function (data) {
        if (data == "entry_exist") {
          alert("Entry Was Found");
        } else {
          // console.log(data);
          $("#marks").val("");
        }
      },
    });
  }
};

updateEntry = () => {
  $.ajax({
    url: "./resources/process.php?updateEntry=true",
    method: "POST",
    data: $("#frmUpdateEntry").serialize(),
    success: function (data) {
      if (data == "1") {
        alert("update successfull");
      }
      // console.log(data);
    },
  });
};

printReport = (id) => {
  var printContent = document.getElementById(id);
  var WinPrint = window.open("", "", "width=900, height=650");
  WinPrint.document.write(`<!DOCTYPE html>\
  <html lang="en">\
  
  <head>\
      <meta charset="UTF-8">\
      <meta http-equiv="X-UA-Compatible" content="IE=edge">\
      <meta name="viewport" content="width=device-width, initial-scale=1.0">\
      <title>Student Report Form</title>\
      <link rel="stylesheet" type="text/css" href="./Assets/font-awesome/css/font-awesome.min.css">\
      <link rel="stylesheet" type="text/css" href="./Assets/felabs/felabs.css">\
      <link rel="stylesheet" type="text/css" href="./Assets/felabs/style.css">\
      <style>\
      th,\
      td {\
          border: 1px solid #ccc;\
      }\
      </style>\
  </head>\
  
  <body class="w3-container w3-padding">${printContent.innerHTML}`);
  WinPrint.document.close();
  WinPrint.focus();
  WinPrint.print();
  WinPrint.close();
};
