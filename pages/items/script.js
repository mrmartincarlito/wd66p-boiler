/**
 * @var change url
 */

let itemsTable;
index();
function index() {
    itemsTable = $("#records").DataTable({
        processing : true,
        ajax : {
            url : ITEMS_API,
            dataSrc : function (response) {
                let return_data = new Array();
                let dataResponse = response.data;

                for (let i = 0; i<dataResponse.length; i++) 
                {
                    let id = dataResponse[i].id
                    return_data.push({
                        //@TODO
                        //@var change keys depending on the table
                        id : id,
                        name :  dataResponse[i].name,
                        price :  dataResponse[i].price,
                        stocks :  dataResponse[i].stocks,
                        // date_time : response.records[i].date_time,
                        action : "<button onclick='viewUser(" + id + ")' class='btn btn-warning'>VIEW</button> <button class='btn btn-danger' onclick='destroy(" + id + ")'>DELETE</button></td>"
                    });
                }

                return return_data;
            },
            complete : function() {
                //@TODO
                //@var change databale 
                $('#records tbody').on('dblclick', 'tr', function() {
                    let data = $('#records')
                        .DataTable()
                        .row(this)
                        .data()
                    alert(data.id)
                    //     $("#idToBeDisplay").html(data.id)
                    // $("#name").val(data.name);
                    // $("#price").val(data.price);
                    // $("#modalClickerShow").click();

                    // $("#saveButton").hide();
                    // $("#updateButton").show();
                    // $("#showId").show();
                });
            },
        },
        columns : [
            //@TODO
            //@var change data keys depending on the table column declared above
            { data : 'id' },
            { data : 'name' },
            { data : 'price' },
            { data : 'stocks' },
            { data : 'action' },
        ],
        dom : 'lBfrtip',
        buttons : [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ]
    });
}

function indexBack() {
    $.ajax({
        "url" : USERS_API, //URL of the API
        "type" : "GET", //GET and POST 
        "data" : "index", //auth will be our php variable $_POST['auth']
        "success" : function (response) { //success yung response
            let parseResponse = JSON.parse(response);
            //Do certain process

            let contents = parseResponse.data;
            let tr = "";
            let cards = "";
            for (let i = 0; i <contents.length; i++) {
                let id = contents[i].id
                tr += "<tr>" + 
                    "<td>" + id + "</td>" + 
                    "<td>" + contents[i].fname + "</td>" + 
                    "<td>" + contents[i].lname + "</td>" + 
                    "<td>" + contents[i].username + "</td>" + 
                    "<td>" + contents[i].created_at + "</td>" + 
                    "<td><button onclick='viewUser(" + id + ")' class='btn btn-warning'>VIEW</button> <button class='btn btn-danger' onclick='destroy(" + id + ")'>DELETE</button></td>" + 
                "</tr>";

                cards += '<div class="col">' +
                    '<div class="card" style="width: 18rem;">' +
                        '<div class="card-body">' +
                            '<h5 class="card-title">' + contents[i].fname + ' ' + contents[i].lname + '</h5>' +
                            '<p class="card-text"></p>' +
                            "<button onclick='viewUser(" + id + ")' class='btn btn-warning'>VIEW</button> <button class='btn btn-danger' onclick='destroy(" + id + ")'>DELETE</button>" +
                        '</div>' +
                    '</div>' +
                '</div>' 

            }
         
            $("#cards").html(cards)
            $("#content").html(tr)
        },
        "error" : function (xhr, status, error) { //error yung response
            alert("Error")
        }
    });
}

function show(id) {
    let idRequest = { "id" : id}; //$("#id").val() <- dito naka lagay yung specific id

    $.ajax({
        "url" : USERS_API, //URL of the API
        "type" : "GET", //GET and POST 
        "data" : "show=" + JSON.stringify(idRequest), //auth will be our php variable $_POST['auth']
        "success" : function (response) { //success yung response

            let parseResponse = JSON.parse(response);
            
            $("#id").val(parseResponse.data[0].id)
            $("#fname").val(parseResponse.data[0].fname)
            $("#lname").val(parseResponse.data[0].lname)
            $("#username").val(parseResponse.data[0].username)

        },
        "error" : function (xhr, status, error) { //error yung response
            alert("Error")
        }
    });
}


function store() {
    let record = {
        "name" : $("#name").val(),
        "price" : $("#price").val(),
        "stocks" : $("#stocks").val(),
        "email" : $("#email").val()
    }

    $.ajax({
        "url" : ITEMS_API, //URL of the API
        "type" : "POST", //GET and POST 
        "data" : record,
        "success" : function (response) { //success yung response
            console.log(response)
            alert(response.message)
            itemsTable.ajax.reload(null, false)
        },
        "error" : function (xhr, status, error) { //error yung response
            alert("Error")
        }
    });
}

function update() {
    let record = { 
        "fname" : $("#fname").val(),
        "lname" : $("#lname").val(),
        "username" : $("#username").val(),
    } 

    let id = $("#id").val(); //$("#id").val() <- dito naka lagay yung specific id
    let updateRequest = {
        "id" : id,
        "record" : record
    }

    $.ajax({
        "url" : USERS_API, //URL of the API
        "type" : "POST", //GET and POST 
        "data" : "update=" + JSON.stringify(updateRequest), //auth will be our php variable $_POST['auth']
        "success" : function (response) { //success yung response
            console.log(response)
            let parseResponse = JSON.parse(response);
            //Do certain process
            $("#container").html("<h1>" + parseResponse.title + "</h1>" + "<h2>" + parseResponse.description + "</h2>");
            show(id)
        },
        "error" : function (xhr, status, error) { //error yung response
            alert("Error")
        }
    });
}

function destroy(id) {

    if (!confirm("Are you sure you want to delete?")) {
        return;
    }

    $.ajax({
        "url" : ITEMS_API + "/delete-customize-method/" + id, //URL of the API
        "type" : "POST", //GET and POST 
        "data" : "", //auth will be our php variable $_POST['auth']
        "success" : function (response) { //success yung response
            console.log(response)
            
            //Do certain process
            alert(response.message)

            if (response.status == 200) {
                //index();
                //itemsTable.ajax.reload(null, false)
            }
        },
        "error" : function (xhr, status, error) { //error yung response
            alert("Error")
        }
    });
}

function viewUser(id) {
    window.location.href = "view.html?q=" + id 
}

function getAllCourses() {
    $.ajax({
        "url" : COURSE_API, //URL of the API
        "type" : "GET", //GET and POST 
        "data" : "index", //auth will be our php variable $_POST['auth']
        "success" : function (response) { //success yung response
            let parseResponse = JSON.parse(response);
            //Do certain process

            let contents = parseResponse.data;
            let options = "";
            for (let i = 0; i <contents.length; i++) {
                let id = contents[i].id
                options += "<option value='" +id+ "'>" + contents[i].name + "</option>"
            }
            $("#course").html(options)
        },
        "error" : function (xhr, status, error) { //error yung response
            alert("Error")
        }
    });
}