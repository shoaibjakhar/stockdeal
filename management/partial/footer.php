<script type="text/javascript">
    var winHeight = $(window).height()
    $('.sidebar, .main_container').height(winHeight);


    $('.subscribers').dataTable({
        "bPaginate": false,
        "scrollY": "400px",
        "sScrollX": "100%",
        "aaSorting": []

    });
	
	
	$('#veiw_Leads').dataTable({
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": false,
		"bAutoWidth": false,
		//scrollY": 200,
		"scrollX": true,
		"scrollY": $(window).height() - 280+"px",
		//"scrollCollapse": true,
		 fixedColumns:   {
            leftColumns: 1
            //rightColumns: 1
        },
		  "aaSorting": []
		 });
		 
		 
		 $('#veiw_Leadstest').dataTable({
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": true,
		"bAutoWidth": false,
		//scrollY": 200,
		//"scrollX": true,
		"scrollY": $(window).height() - 280+"px",
		//"scrollCollapse": true,
		 "order": [[1, 'ase']]
		 });
		 
	
		
	$('#FollowUpHistory').dataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": true,
        "bAutoWidth": false,
        "scrollY": $(window).height() - 280+"px",
        "sScrollX": "100%",
        "bScrollCollapse": true,
        "scrollCollapse": true,
        "aaSorting": []

    });

    /*
       $('').dataTable({
    	   "bPaginate": false,
        "scrollY": "400px",
    	"sScrollX": "100%",
    	fixedColumns:   {
                leftColumns: 1,
                rightColumns: 1
            },
    	 "aaSorting": []
    	
    	 });*/


    var table = $('#ViewLeads').DataTable({
        scrollY: $(window).height() - 280+"px",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        fixedColumns: {
            leftColumns: 2

        },
        "aaSorting": []
    });

    var table = $('#ViewLeadsDelete').DataTable({
        scrollY: $(window).height() - 280+"px",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        fixedColumns: {
            leftColumns: 2

        },

    });

    var table = $('#ViewLeadsFilter').DataTable({
        scrollY: $(window).height() - 280+"px",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        fixedColumns: {
            leftColumns: 2

        },

    });




    $('#freeTrail').dataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": true,
        "bAutoWidth": false,
        "scrollY": $(window).height() - 280+"px",
        "sScrollX": "100%",
        "bScrollCollapse": true,
        "scrollCollapse": true,
        "aaSorting": []

    });


    $('#Customer_profile').dataTable({
        "bPaginate": false,
        "bLengthChange": true,// ture by softwebies
        "bFilter": true,
        "bInfo": true,
        "bAutoWidth": false,
        // "scrollY": $(window).height() - 300+"px",//comment by  softwebies
        "sScrollX": "100%",
        "bScrollCollapse": true,
        "scrollCollapse": true,
        "aaSorting": [],
        "pageLength": 10,//added by softwebies
         "paging":         true,
		 "columnDefs": [ {
"targets": 0,
"orderable": false
} ]

    });
	
	 $('#Clients').dataTable({
        // "bPaginate": false,
        // "bLengthChange": true,// ture by softwebies
        // "bFilter": true,
        // "bInfo": true,
        // "bAutoWidth": false,
        // //"scrollY": $(window).height() - 250+"px", softwebies
        "sScrollX": "100%",
        "paging":false,
        // "bScrollCollapse": true,
        // "scrollCollapse": true,
        // "aaSorting": [],
        // "bLengthChange": true,// ture by softwebies
        // "pageLength": 10,//added by softwebies
		 

    });

    $('#employee').dataTable({
        // "bPaginate": false,
        // "bLengthChange": true,// ture by softwebies
        // "bFilter": true,
        // "bInfo": true,
        // "bAutoWidth": false,
        // //"scrollY": $(window).height() - 250+"px", softwebies
        "sScrollX": "100%",
        "paging":false,
        "searching": false,
        // "bScrollCollapse": true,
        // "scrollCollapse": true,
        // "aaSorting": [],
        // "bLengthChange": true,// ture by softwebies
        // "pageLength": 10,//added by softwebies
         

    });


	 $('#Agent_request').dataTable({
		 "bPaginate": false,
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": true,
		"bAutoWidth": false,
		//scrollY": 200,
		"scrollX": true,
		"scrollY": $(window).height() - 280+"px",
		//"scrollCollapse": true,
		 
	
		  "aaSorting": []
		 
         
	 });
	 

    var t = $('#SalesAgentWise').DataTable({
        "bPaginate": false,
        "bInfo": false,
        "bSort": false,

        "columnDefs": [{

            "scrollY": "280px",
            "searchable": false,
            "orderable": false,
            "targets": 0
        }],
        "order": [[1, 'asc']]
    });

    t.on('order.dt search.dt', function () {
        t.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();







    function Update() {

        if (window.XMLHttpRequest) {

            aa = new XMLHttpRequest();
        }

        aa.onreadystatechange = function () {
            if (aa.readyState == 4 && aa.status == 200) {
                document.getElementById("txtHint").innerHTML = aa.responseText;
            }
        }


        var DispositionAgent = document.getElementById('DispositionAgent').value
        var DispositionAgentId = document.getElementById('DispositionAgentId').value

        aa.open("GET", "updateAgentDispotion.php?DispositionAgent=" + DispositionAgent + "&DispositionAgentId=" + DispositionAgentId, true);
        aa.send();
        //alert(DispositionAgent+' '+DispositionAgentId)


    }


    $(document).ready(function () {
        //alert('asdf')



        $('.ChangeAgent').change(function () {

            $('#DispositionAgent').val($(this).val())
            $('#DispositionAgentId').val($(this).prev().val())


            setTimeout(function () {
                $('.alert-success').fadeOut();
                $('#DispositionAgentUpdate').trigger('click');
                $('.alert-success').fadeIn();
            }, 300);





            setTimeout(function () {
                $('.alert-success').fadeOut();

            }, 3000);



        });



        var pageTitle = $(document).find("title").text(); //#34495e
/*
        if (pageTitle == 'Dashboard') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(1)').addClass('active')
        } else if (pageTitle == 'Sales Agent Wise') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(2)').addClass('active')
        }  else if (pageTitle == 'Customer Profile') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(3)').addClass('active')
        } else if (pageTitle == 'Stock Tips') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(4)').addClass('active')
        } else if (pageTitle == 'Assigned Leads') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(5)').addClass('active')
        } else if (pageTitle == 'View Leads') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(6)').addClass('active')
        } else if (pageTitle == 'Follow Up History') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(7)').addClass('active')
        } else if (pageTitle == 'Website Leads') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(8)').addClass('active')
        } else if (pageTitle == 'Event Requests') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(8)').addClass('active')
        } else if (pageTitle == 'Terms and conditions') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(9)').addClass('active')
        }	
		else if (pageTitle == 'Agent') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(10)').addClass('active')
        }
		else if (pageTitle == 'Change Password') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(11)').addClass('active')
        }
		else if (pageTitle == 'Analytics Reports') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(12)').addClass('active')
        }
		else if (pageTitle == 'Attendence') {
            $('.sidebar li').removeClass('active')
			$('.sidebar li:nth-child(13)').addClass('active')
        }
		*/
		



    });
</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../assests/search.js"></script>

<script>
    function confirmation()
     {
    swal("Sending Offer Letter!");

    }
</script>
