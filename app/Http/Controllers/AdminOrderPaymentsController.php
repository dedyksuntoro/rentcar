<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminOrderPaymentsController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->button_edit = false;
			$this->button_delete = false;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "tbl_order_payments";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Order","name"=>"id_order","join"=>"tbl_orders,order_number"];
			$this->col[] = ["label"=>"Payment Amount","name"=>"payment_amount","callback_php"=>'"Rp. ".number_format($row->payment_amount)'];
			$this->col[] = ["label"=>"Remaining Payment","name"=>"remaining_payment","callback_php"=>'"Rp. ".number_format($row->remaining_payment)'];
			$this->col[] = ["label"=>"Type Payment","name"=>"type_payment"];
			$this->col[] = ["label"=>"Proof Payment","name"=>"proof_payment","image"=>true];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Order','name'=>'id_order','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'tbl_orders,order_number'];
			$this->form[] = ['label'=>'Payment Amount','name'=>'payment_amount','type'=>'money','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Remaining Payment','name'=>'remaining_payment','type'=>'hidden','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Type Payment','name'=>'type_payment','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-10','dataenum'=>'Cash;Transfer'];
			$this->form[] = ['label'=>'Proof Payment','name'=>'proof_payment','type'=>'upload','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Order","name"=>"id_order","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"order,id"];
			//$this->form[] = ["label"=>"Payment Amount","name"=>"payment_amount","type"=>"money","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Remaining Payment","name"=>"remaining_payment","type"=>"money","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Type Payment","name"=>"type_payment","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Proof Payment","name"=>"proof_payment","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
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
	        $this->script_js = "
            $('#proof_payment').prop('disabled', true);
            $('#type_payment').change(function(){
                if($('#type_payment').val() == 'Cash'){
                    $('#proof_payment').prop('disabled', true);
                }else{
                    $('#proof_payment').prop('disabled', false);
                }
            });
            ";


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
	        $this->style_css = NULL;



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
	        //Your code here

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
            $get_remaining_payment = DB::table($this->table)->select('remaining_payment')->where('id_order', $postdata['id_order'])->orderBy('id', 'desc')->first();

            if($get_remaining_payment->remaining_payment === null){ //ketika sisa pembayaran null
                $get_total_payment = DB::table('tbl_orders')->select('total')->where('id', $postdata['id_order'])->first();
                if($postdata['payment_amount'] > $get_total_payment->total){
                    CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"The payment amount is greater than the total payment.","warning");
                }else{
                    if($postdata['payment_amount'] == 0){
                        CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Check the payment amount!","warning");
                    }else{
                        $remaining_payment = $get_total_payment->total - $postdata['payment_amount'];
                        if($remaining_payment == 0){
                            DB::table('tbl_orders')->where('id', $postdata['id_order'])->update(['pay_status' => 'Paid']);
							$get_idcar = DB::table('tbl_orders')->select('id_car')->where('id', $postdata['id_order'])->first();
							DB::table('tbl_cars')->where('id', $get_idcar->id_car)->update(['on_duty' => null]);
                        }else{
                            DB::table('tbl_orders')->where('id', $postdata['id_order'])->update(['pay_status' => 'Installments']);
                        }
                        $postdata['remaining_payment'] = $remaining_payment;
                    }
                }
            }elseif($get_remaining_payment->remaining_payment == 0){ //ketika sisa pembayaran 0
                CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Payment has been paid.","warning");
            }else{ //ketika sisa pembayarn sudah diangsur
                if($postdata['payment_amount'] > $get_remaining_payment->remaining_payment){ //ketika inputan lbh besar dari sisa pembayaran
                    CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"The payment amount is greater than the remaining payment.","warning");
                }else{
                    if($postdata['payment_amount'] == 0){ //ketika inputan berisikan 0
                        CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Check the payment amount!","warning");
                    }else{
                        $remaining_payment = $get_remaining_payment->remaining_payment - $postdata['payment_amount'];
                        if($remaining_payment == 0){
                            DB::table('tbl_orders')->where('id', $postdata['id_order'])->update(['pay_status' => 'Paid']);
							$get_idcar = DB::table('tbl_orders')->select('id_car')->where('id', $postdata['id_order'])->first();
							DB::table('tbl_cars')->where('id', $get_idcar->id_car)->update(['on_duty' => null]);
                        }else{
                            DB::table('tbl_orders')->where('id', $postdata['id_order'])->update(['pay_status' => 'Installments']);
                        }
                        $postdata['remaining_payment'] = $remaining_payment;
                    }
                }
            }
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
	        //Your code here

	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------
	    | @id       = current id
	    |
	    */
	    public function hook_after_edit($id) {
	        //Your code here

	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------
	    | @id       = current id
	    |
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /*
	    | ----------------------------------------------------------------------
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------
	    | @id       = current id
	    |
	    */
	    public function hook_after_delete($id) {
            //ketika delete pembayaran semua pay status unpaid
	        // $get_count_payment = DB::table('tbl_order_payments')->where('id', $id)->count();
            // if($get_count_payment == 0){
            //     $get_id_order = DB::table('tbl_order_payments')->where('id', $id)->get();
            //     dd($id);
            //     DB::table('tbl_orders')->where('id', $get_id_order->id_order)->update(['pay_status' => 'Unpaid']);
            // }
	    }



	    //By the way, you can still create your own method in here... :)


	}
