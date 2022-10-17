<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
    use DatePeriod;
    use DateTime;
    use DateInterval;

	class AdminOrdersController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = false;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = false;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "tbl_orders";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Order Number","name"=>"order_number"];
			$this->col[] = ["label"=>"Branch","name"=>"id_branch","join"=>"tbm_branch,branch_name"];
			$this->col[] = ["label"=>"Manufacturer","name"=>"(SELECT tbm_car_manufacturer.manufacturer FROM tbl_cars JOIN tbm_car_manufacturer ON tbm_car_manufacturer.id = tbl_cars.id_manufacturer WHERE tbl_cars.id = tbl_orders.id_car) as manufacturer"];
			$this->col[] = ["label"=>"Brand","name"=>"(SELECT tbm_car_brand.brand FROM tbl_cars JOIN tbm_car_brand ON tbm_car_brand.id = tbl_cars.id_brand WHERE tbl_cars.id = tbl_orders.id_car) as brand"];
			$this->col[] = ["label"=>"Customer","name"=>"id_customer","join"=>"tbl_customers,customer_name"];
			$this->col[] = ["label"=>"Pay Status","name"=>"pay_status"];
			$this->col[] = ["label"=>"Total Price","name"=>"total","callback_php"=>'"Rp. ".number_format($row->total)'];
			$this->col[] = ["label"=>"Additional Cost","name"=>"additional_cost","callback_php"=>'"Rp. ".number_format($row->additional_cost)'];
			$this->col[] = ["label"=>"Order Date","name"=>"created_at"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			// dd(CRUDBooster::getCurrentMethod());
			$this->form = [];
			if(CRUDBooster::getCurrentMethod() == 'getEdit' || CRUDBooster::getCurrentMethod() == 'getDetail' || CRUDBooster::getCurrentMethod() == 'postEditSave'):
				// $this->form[] = ['label'=>'Order Number','name'=>'order_number','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10','disabled'=>true];
				// $this->form[] = ['label'=>'Price','name'=>'price','type'=>'money','validation'=>'required|integer|min:0','width'=>'col-sm-10','readonly'=>true];
				// $this->form[] = ['label'=>'Total Days','name'=>'total_days','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10','readonly'=>true];
				// $this->form[] = ['label'=>'Total Hour','name'=>'total_hour','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10','readonly'=>true];
				// $this->form[] = ['label'=>'Discount','name'=>'discount','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10','readonly'=>true];
				$this->form[] = ['label'=>'Additional Cost','name'=>'additional_cost','type'=>'money','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
				$this->form[] = ['label'=>'Description','name'=>'description_add_cost','type'=>'textarea'];
				$this->form[] = ['label'=>'Initial Total','name'=>'initial_total','type'=>'hidden','width'=>'col-sm-10'];
				$this->form[] = ['label'=>'Total','name'=>'total','type'=>'hidden','validation'=>'required|min:0','width'=>'col-sm-10','readonly'=>true];
				// $this->form[] = ['label'=>'Pay Status','name'=>'pay_status','type'=>'hidden','validation'=>'required','width'=>'col-sm-10'];
			else:
				$this->form[] = ['label'=>'Order Number','name'=>'order_number','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
				$this->form[] = ['label'=>'Branch','name'=>'id_branch','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
				$this->form[] = ['label'=>'Customer','name'=>'id_customer','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'tbl_customers,customer_name'];
				$this->form[] = ['label'=>'Car','name'=>'id_car','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'tbl_cars,id'];
				$this->form[] = ['label'=>'Price','name'=>'price','type'=>'money','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
				$this->form[] = ['label'=>'Rental Type','name'=>'rent_type','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
				$this->form[] = ['label'=>'Booking Date','name'=>'booking_date','type'=>'date','validation'=>'required|min:0','width'=>'col-sm-10'];
				$this->form[] = ['label'=>'Pickup Time','name'=>'pickup_time','type'=>'time','validation'=>'required|min:0','width'=>'col-sm-10'];
				$this->form[] = ['label'=>'Total Days','name'=>'total_days','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
				$this->form[] = ['label'=>'Return Date','name'=>'return_date','type'=>'date','validation'=>'required|min:0','width'=>'col-sm-10'];
				$this->form[] = ['label'=>'Back Hour','name'=>'back_hour','type'=>'time','validation'=>'required|min:0','width'=>'col-sm-10'];
				$this->form[] = ['label'=>'Total Hour','name'=>'total_hour','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
				$this->form[] = ['label'=>'Discount','name'=>'discount','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
				$this->form[] = ['label'=>'Total','name'=>'total','type'=>'money','validation'=>'required|min:0','width'=>'col-sm-10'];
				$this->form[] = ['label'=>'Initial Total','name'=>'initial_total','type'=>'hidden','width'=>'col-sm-10'];
				$this->form[] = ['label'=>'Pay Status','name'=>'pay_status','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			endif;
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Order Number","name"=>"order_number","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Customer","name"=>"id_customer","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"customer,id"];
			//$this->form[] = ["label"=>"Car","name"=>"id_car","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"car,id"];
			//$this->form[] = ["label"=>"Price","name"=>"price","type"=>"money","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Discount","name"=>"discount","type"=>"money","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Total Days","name"=>"total_days","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Total","name"=>"total","type"=>"money","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Pay Status","name"=>"pay_status","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			# OLD END FORM

			/*
	        | ----------------------------------------------------------------------
	        | Sub Module
	        | ----------------------------------------------------------------------
			| @label          = Label of action
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        |
	        */
	        $this->sub_module = array();
            $this->sub_module[] = ['label'=>'Payment','path'=>'order_payments','parent_columns'=>'order_number,price,datemin,datemax,total_days,hourmin,hourmax,total_hour,discount,additional_cost,total,pay_status',
                'parent_columns_alias'=>'Order Number,Price,Start Date,End Date,Total Day,Start Hour,End Hour,Total Hour,Discount,Additional Cost,Total Price,Pay Status','foreign_key'=>'id_order','button_color'=>'success','button_icon'=>'fa fa-money'];

	        /*
	        | ----------------------------------------------------------------------
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------
	        | @label       = Label of action
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        |
	        */
	        $this->addaction = array();
			$this->addaction[] = ['label'=>'Additional Cost','url'=>CRUDBooster::mainpath('edit/[id]'),'icon'=>'fa fa-money','color'=>'success','showIf'=>"[pay_status] != 'Paid'"];
			$this->addaction[] = ['label'=>'Additional Cost','url'=>CRUDBooster::mainpath('detail/[id]'),'icon'=>'fa fa-money','color'=>'success','showIf'=>"[pay_status] === 'Paid'"];


	        /*
	        | ----------------------------------------------------------------------
	        | Add More Button Selected
	        | ----------------------------------------------------------------------
	        | @label       = Label of action
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button
	        | Then about the action, you should code at actionButtonSelected method
	        |
	        */
	        $this->button_selected = array();


	        /*
	        | ----------------------------------------------------------------------
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------
	        | @message = Text of message
	        | @type    = warning,success,danger,info
	        |
	        */
	        $this->alert        = array();



	        /*
	        | ----------------------------------------------------------------------
	        | Add more button to header button
	        | ----------------------------------------------------------------------
	        | @label = Name of button
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        |
	        */
	        $this->index_button = array();



	        /*
	        | ----------------------------------------------------------------------
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.
	        |
	        */
	        $this->table_row_color = array();
			$this->table_row_color[] = ['condition'=>"[pay_status] == 'Paid'","color"=>"success"];
			$this->table_row_color[] = ['condition'=>"[pay_status] == 'Unpaid'","color"=>"danger"];
			$this->table_row_color[] = ['condition'=>"[pay_status] == 'Installments'","color"=>"warning"];

	        /*
	        | ----------------------------------------------------------------------
	        | You may use this bellow array to add statistic at dashboard
	        | ----------------------------------------------------------------------
	        | @label, @count, @icon, @color
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ----------------------------------------------------------------------
	        | Add javascript at body
	        | ----------------------------------------------------------------------
	        | javascript code in the variable
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = '
                $(function () {
					$("#rent_type").change(function(){
						var type = $("option:selected", this).text();
						if(type == "Daily"){
							$(".total_days").show();
							$(".total_hour").hide();
							$("#total_days").prop("disabled", false);
							$("#total_hour").prop("disabled", true);
							$("#total_days").val("");
							$("#total_hour").val("");
							$("#id_cars").val("");
							$("#price").val("");
							$("#discount").val("");
							$("#total").val("");
                            $("#booking_date").val("");
							$("#pickup_time").val("");
							$("#return_date").val("");
							$("#back_hour").val("");
						}else if(type == "Hourly"){
							$(".total_days").hide();
							$(".total_hour").show();
							$("#total_days").prop("disabled", true);
							$("#total_hour").prop("disabled", false);
							$("#total_days").val("");
							$("#total_hour").val("");
							$("#id_cars").val("");
							$("#price").val("");
							$("#discount").val("");
							$("#total").val("");
							$("#booking_date").val("");
							$("#pickup_time").val("");
                            $("#return_date").val("");
							$("#back_hour").val("");
						}
					});

                    $("#id_cars").change(function(){
						var type = $("option:selected", "#rent_type").text();
						if(type == "Daily"){
							var price = $("option:selected", this).text().split("|");
							$("#price").val(price[1].replace(/[^0-9]/gi, ""));
							if($("#discount").val() == null || $("#discount").val() == 0 || $("#discount").val() == ""){
								$("#total").val($("#price").val() * $("#total_days").val());
							}else{
								$("#total").val($("#price").val() * $("#total_days").val() - ($("#price").val() * $("#total_days").val() * $("#discount").val() / 100));
							}
							$(".inputMoney#total").priceFormat({"prefix":"","thousandsSeparator":",","centsLimit":"0","clearOnEmpty":false});
						}else if(type == "Hourly"){
							var price = $("option:selected", this).text().split("|");
							$("#price").val(price[2].replace(/[^0-9]/gi, ""));
							if($("#discount").val() == null || $("#discount").val() == 0 || $("#discount").val() == ""){
								$("#total").val($("#price").val() * $("#total_hour").val());
							}else{
								$("#total").val($("#price").val() * $("#total_hour").val() - ($("#price").val() * $("#total_hour").val() * $("#discount").val() / 100));
							}
							$(".inputMoney#total").priceFormat({"prefix":"","thousandsSeparator":",","centsLimit":"0","clearOnEmpty":false});
						}
                    });

                    $("#total_days").keyup(function(){
                        var startDateTime = $("#booking_date").val() + " " + $("#pickup_time").val();
                        var newDateTime = moment(startDateTime, "YYYY-MM-DD hh:mm")
                                            .add($(this).val(), "days")
                                            .format("YYYY-MM-DD HH:mm");
                        var newDateTime_split = newDateTime.split(" ");
                        $("#return_date").val(newDateTime_split[0]);
                        $("#back_hour").val(newDateTime_split[1]);
                        if($("#discount").val() == null || $("#discount").val() == 0 || $("#discount").val() == ""){
                            $("#total").val($("#price").val() * $("#total_days").val());
                        }else{
                            $("#total").val(($("#price").val() * $("#total_days").val() / 100) * $("#discount").val());
                            $("#total").val($("#price").val() * $("#total_days").val() - ($("#price").val() * $("#total_days").val() * $("#discount").val() / 100));
                        }
                        $(".inputMoney#total").priceFormat({"prefix":"","thousandsSeparator":",","centsLimit":"0","clearOnEmpty":false});
                    });

					$("#total_hour").keyup(function(){
                        var startDateTime = $("#booking_date").val() + " " + $("#pickup_time").val();
                        var newDateTime = moment(startDateTime, "YYYY-MM-DD hh:mm")
                                            .add($(this).val(), "hours")
                                            .format("YYYY-MM-DD HH:mm");
                        var newDateTime_split = newDateTime.split(" ");
                        $("#return_date").val(newDateTime_split[0]);
                        $("#back_hour").val(newDateTime_split[1]);
                        if($("#discount").val() == null || $("#discount").val() == 0 || $("#discount").val() == ""){
                            $("#total").val($("#price").val() * $("#total_hour").val());
                        }else{
                            $("#total").val(($("#price").val() * $("#total_hour").val() / 100) * $("#discount").val());
                            $("#total").val($("#price").val() * $("#total_hour").val() - ($("#price").val() * $("#total_hour") * $("#discount").val() / 100));
                        }
                        $(".inputMoney#total").priceFormat({"prefix":"","thousandsSeparator":",","centsLimit":"0","clearOnEmpty":false});
                    });

                    $("#booking_date, #pickup_time").change(function(){
                        $("#total_hour").val("");
                        $("#return_date").val("");
                        $("#back_hour").val("");
                    });

                    $("#discount").keyup(function(){
						var type = $("option:selected", "#rent_type").text();
						if(type == "Daily"){
							if($(this).val() == null || $(this).val() == 0 || $(this).val() == ""){
								$("#total").val($("#price").val() * $("#total_days").val());
							}else{
								$("#total").val($("#price").val() * $("#total_days").val() - ($("#price").val() * $("#total_days").val() * $(this).val() / 100));
							}
							$(".inputMoney#total").priceFormat({"prefix":"","thousandsSeparator":",","centsLimit":"0","clearOnEmpty":false});
						}else if(type == "Hourly"){
							if($(this).val() == null || $(this).val() == 0 || $(this).val() == ""){
								$("#total").val($("#price").val() * $("#total_hour").val());
							}else{
								$("#total").val($("#price").val() * $("#total_hour").val() - ($("#price").val() * $("#total_hour").val() * $(this).val() / 100));
							}
							$(".inputMoney#total").priceFormat({"prefix":"","thousandsSeparator":",","centsLimit":"0","clearOnEmpty":false});
						}
                    });

					// var arr_total = [];
					// arr_total.push($("#total").val().replace(/[^0-9]/gi, ""));
					// $("#additional_cost").keyup(function(){
					// 	var cost = parseInt($(this).val().replace(/[^0-9]/gi, ""));
					// 	var arrtotal = parseInt(arr_total);
					// 	console.log(arrtotal);
					// 	var total = ((arrtotal) + (cost));
					// 	if($(this).val() == 0){
					// 		$("#total").val(arr_total);
					// 	}else{
					// 		$("#total").val(total);
					// 	}
					// 	$(".inputMoney#total").priceFormat({"prefix":"","thousandsSeparator":",","centsLimit":"0","clearOnEmpty":false});
                    // });
                });
            ';


            /*
	        | ----------------------------------------------------------------------
	        | Include HTML Code before index table
	        | ----------------------------------------------------------------------
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;



	        /*
	        | ----------------------------------------------------------------------
	        | Include HTML Code after index table
	        | ----------------------------------------------------------------------
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;



	        /*
	        | ----------------------------------------------------------------------
	        | Include Javascript File
	        | ----------------------------------------------------------------------
	        | URL of your javascript each array
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();



	        /*
	        | ----------------------------------------------------------------------
	        | Add css style at body
	        | ----------------------------------------------------------------------
	        | css code in the variable
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = "
			.btn-detail {
				display: none;
			}
			.btn-edit {
				display: none;
			}
			";



	        /*
	        | ----------------------------------------------------------------------
	        | Include css File
	        | ----------------------------------------------------------------------
	        | URL of your css each array
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();


	    }

        // public function getIndex() {
        //     if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));

        //     $data = [];
        //     $data['page_title'] = 'Orders';
        //     $data['get_orders'] = DB::table('tbl_orders')
        //         ->select('tbl_orders.id AS idorder', 'order_number', 'branch_name', 'customer_name', 'manufacturer', 'brand', 'pay_status', 'tbl_orders.created_at as order_date')
        //         ->join('tbm_branch', 'tbm_branch.id', 'tbl_orders.id_branch')
        //         ->join('tbl_customers', 'tbl_customers.id', 'tbl_orders.id_customer')
        //         ->join('tbl_cars', 'tbl_cars.id', 'tbl_orders.id_car')
        //         ->join('tbm_car_manufacturer', 'tbm_car_manufacturer.id', 'tbl_cars.id_manufacturer')
        //         ->join('tbm_car_brand', 'tbm_car_brand.id', 'tbl_cars.id_brand')
        //         ->orderby('tbl_orders.id', 'desc')
        //         ->paginate(10);

        //     return $this->view('orders/orders_index', $data);
        // }

        public function getAdd() {
            if(!CRUDBooster::isCreate() && $this->global_privilege==FALSE || $this->button_add==FALSE) {
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }

            $data = [];
            $data['page_title'] = 'Form Add Orders';
			if (CRUDBooster::me()->id_branch != 0) {
				$data['get_branch'] = DB::table('tbm_branch')->where('id', CRUDBooster::me()->id_branch)->get();
                $data['get_customer'] = DB::table('tbl_customers')->where('id_branch', CRUDBooster::me()->id_branch)->where('status', 1)->get();
                $data['get_car'] = DB::table('tbl_cars')
                    ->select('tbl_cars.id AS idcar', 'tbl_cars.on_duty AS onduty', 'tbm_car_brand.brand AS brand', 'tbm_car_manufacturer.manufacturer AS manufacturer', 'tbl_cars.price_perday AS priceperday', 'tbl_cars.price_perhour AS priceperhour')
                    ->join('tbm_car_brand', 'tbm_car_brand.id', 'tbl_cars.id_brand')
                    ->join('tbm_car_manufacturer', 'tbm_car_manufacturer.id', 'tbm_car_brand.id_manufacturer')
                    ->where('id_branch', CRUDBooster::me()->id_branch)
                    // ->where('tbl_cars.on_duty', null)
                    ->get();
			}else{
				$data['get_branch'] = DB::table('tbm_branch')->get();
                $data['get_customer'] = DB::table('tbl_customers')->where('status', 1)->get();
                $data['get_car'] = DB::table('tbl_cars')
                    ->select('tbl_cars.id AS idcar', 'tbl_cars.on_duty AS onduty', 'tbm_car_brand.brand AS brand', 'tbm_car_manufacturer.manufacturer AS manufacturer', 'tbl_cars.price_perday AS priceperday', 'tbl_cars.price_perhour AS priceperhour')
                    ->join('tbm_car_brand', 'tbm_car_brand.id', 'tbl_cars.id_brand')
                    ->join('tbm_car_manufacturer', 'tbm_car_manufacturer.id', 'tbm_car_brand.id_manufacturer')
                    // ->where('tbl_cars.on_duty', null)
                    ->get();
			}

            return $this->view('orders/orders_add',$data);
        }


	    /*
	    | ----------------------------------------------------------------------
	    | Hook for button selected
	    | ----------------------------------------------------------------------
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here

	    }


	    /*
	    | ----------------------------------------------------------------------
	    | Hook for manipulate query of index result
	    | ----------------------------------------------------------------------
	    | @query = current sql query
	    |
	    */
	    public function hook_query_index(&$query) {
            if(CRUDBooster::me()->id_branch != 0){
                $query->where('tbl_orders.id_branch', CRUDBooster::me()->id_branch);
            }
	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for manipulate row of index table html
	    | ----------------------------------------------------------------------
	    |
	    */
	    public function hook_row_index($column_index,&$column_value) {
	    	//Your code here
	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for manipulate data input before add data is execute
	    | ----------------------------------------------------------------------
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {
            $period = new DatePeriod(
                new DateTime($postdata['booking_date']),
                new DateInterval('P1D'),
                new DateTime($postdata['return_date'])
            );

            foreach ($period as $key => $value) {
                // $value->format('Y-m-d');
                $cek_crash = DB::table($this->table)
                    ->whereRaw('DATEDIFF("'.$value->format('Y-m-d').'", booking_date) >= 0')
                    ->whereRaw('DATEDIFF("'.$value->format('Y-m-d').'", return_date) <= 0')
                    ->where('id_car', $postdata['id_car'])
                    ->count('id');

                if ($cek_crash > 0) {
                    CRUDBooster::redirect(CRUDBooster::adminPath(), 'Terdapat benturan jadwal pada tanggal '.$postdata['booking_date'].' sampai dengan tanggal '.$postdata['return_date']);
                }
            }

            if($postdata['discount']=='0'){
                $postdata['discount'] = null;
            }
            $postdata['total'] = preg_replace('/[^\d-]+/', '', $postdata['total']);
            $postdata['initial_total'] = preg_replace('/[^\d-]+/', '', $postdata['total']);
            $postdata['pay_status'] = 'Ordered';
			//Order on duty if finish on duty null
			//If cancel order? delete by owner or administrator
			DB::table('tbl_cars') 
            ->where('id', $postdata['id_car'])
            ->update(['on_duty' => 1]);

            // cek booking crash
            // $cek_booking = DB::table()
	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for execute command after add public static function called
	    | ----------------------------------------------------------------------
	    | @id = last insert id
	    |
	    */
	    public function hook_after_add($id) {
	        //Your code here

	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for manipulate data input before update data is execute
	    | ----------------------------------------------------------------------
	    | @postdata = input post data
	    | @id       = current id
	    |
	    */
	    public function hook_before_edit(&$postdata,$id) {
			$postdata['additional_cost'] = preg_replace('/[^\d-]+/', '', $postdata['additional_cost']);
			if($postdata['additional_cost'] == 0 || $postdata['additional_cost'] == null){
				$postdata['total'] = $postdata['initial_total'];
			}else{
				$postdata['total'] = $postdata['initial_total'] + $postdata['additional_cost'];
			}
	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------
	    | @id       = current id
	    |
	    */
	    public function hook_after_edit($id) {

	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------
	    | @id       = current id
	    |
	    */
	    public function hook_before_delete($id) {
	        $get_idcar = DB::table('tbl_orders')->select('id_car')->where('id', $id)->first();
			DB::table('tbl_cars')->where('id', $get_idcar->id_car)->update(['on_duty' => null]);
	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------
	    | @id       = current id
	    |
	    */
	    public function hook_after_delete($id) {
	        DB::table('tbl_order_payments')->where('id_order', $id)->delete();
	    }



	    //By the way, you can still create your own method in here... :)


	}
