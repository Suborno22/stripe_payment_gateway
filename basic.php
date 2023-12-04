<!-- Place Order  -->

<?php
  #Product Details
  $products=[
    [
      "name"=>"Product1",
      "sku"=>"skucode",
      "units"=>"kg",
      "selling_price"=>100,
      "discount"=>"",
      "tax"=>"",
      "hsn"=>"123456",
      
    ],
    [
      "name"=>"Product2",
      "sku"=>"skucode",
      "units"=>"kg",
      "selling_price"=>150,
      "discount"=>"",
      "tax"=>"",
      "hsn"=>"123456",
      
    ],
    
  ];
  
  #Delivery Customer Details
  $customer=[
    "name"=>"Ram",
    "last_name"=>"R",
    "land_mark"=>"4th cross",
    "address"=>"122, west street",
    "city"=>"salem",
    "pincode"=>"636008",
    "state"=>"Tamilnadu",
    "country"=>"india",
    "email"=>"ram@gmail.com",
    "phone"=>"9876543210",
  ];
  
  #Order Details
  $order_no=date("Ymdhis");
  $order_date=date("Y-m-d h:i");
  $total_amount=250;
  $order_type="code";#cod or online
  
  #order data
  $order_data=[
    "order_id"=>$order_no,
    "order_date"=>$order_date,
    "pickup_location"=> "Primary",
    "comment"=> "",
    "billing_customer_name"=>$customer["name"],
    "billing_last_name"=>$customer["last_name"],
    "billing_address"=>$customer["land_mark"],
    "billing_address_2"=>$customer["address"],
    "billing_city"=> $customer["city"],
    "billing_pincode"=>$customer["pincode"],
    "billing_state"=>$customer["state"],
    "billing_country"=>$customer["country"],
    "billing_email"=>$customer["email"],
    "billing_phone"=>$customer["phone"],
    "shipping_is_billing"=> true,
    "shipping_customer_name"=> "",
    "shipping_last_name"=> "",
    "shipping_address"=> "",
    "shipping_address_2"=> "",
    "shipping_city"=> "",
    "shipping_pincode"=> "",
    "shipping_country"=> "",
    "shipping_state"=> "",
    "shipping_email"=> "",
    "shipping_phone"=> "",
    "order_items"=>$products,
    "payment_method"=>$order_type,
    "shipping_charges"=> 0,
    "giftwrap_charges"=> 0,
    "transaction_charges"=> 0,
    "total_discount"=>0,
    "sub_total"=> $total_amount,
    "length"=> 1,
    "breadth"=> 1,
    "height"=> 1,
    "weight"=> 1,
  ];

  try
  {
    #Login information
    $arr=[
      "email"=>"dsuborno0@gmail.com", 
      "password"=>"q#D:YwM3H?R4fb>",
    ];
    $login_data=json_encode($arr);
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS =>$login_data,
      CURLOPT_HTTPHEADER => array(
      "Content-Type: application/json"
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $res=json_decode($response);
    $token = null;
    #Get login Authentication token
    $token=$res->token;
    if($res->token){
      
      #Place order
      $order_data=json_encode($order_data); 
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>$order_data,
        CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Authorization: Bearer {$token}"
        ),
      ));
      $response = curl_exec($curl);
      curl_close($curl);
      #if order placed, response contains order details for modify or track order.(order_id,shipment_id,status)
      $res=json_decode($response);
      #echo "<pre>";
      #print_r($res);
      #echo "</pre>";
    }
    if($res->status_code==1){
      $msg="Order Placed Successfully";
    }else{
      $msg="Order Placed Failed. Try Again";
    }
  }catch(Exception $e){
    echo $e;
  }
?>

<!-- Order Status and Track Order  -->

<?php
  function getProductStatus($shipment_id){
    try
    {
      #Login information
      $arr1=[
      "email"=>"username",
      "password"=>"password",
      ];
      $login_data=json_encode($arr1);
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>$login_data,
        CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json"
        ),
      ));
      $response = curl_exec($curl);
      curl_close($curl);
      $res=json_decode($response);
      $token = null;
      #Get login Authentication token
      $token=$res->token;
      if($res->token){
        #tracking Order With Shipment id
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/track/shipment/{$shipment_id}",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
          "Content-Type: application/json",
          "Authorization: Bearer {$token}"
          ),
        ));
        $response = curl_exec($curl);
        $res=json_decode($response);
        curl_close($curl);
        return $res;   
      }
    }catch(Exception $e){
      echo $e;
    }
  }
  
  
  $result=getProductStatus("103632461");
  if($result->tracking_data->track_status==0){
    #Display Error
    echo $result->tracking_data->error;
  }
  else if($result->tracking_data->track_status==1){
    #Order Status
    echo "Order Status : ".$o_res->tracking_data->shipment_track[0]->current_status."<br>";
    #Order Track Link
    echo "<a href='".$result->tracking_data->track_url."' >Track Your Order </a>";
  }
?>

<!-- cancel order -->



<?php
#cancel Order
function cancel_order($order_id){
  $arr1=[
    "email"=>"username",
    "password"=>"password",
  ];
  $login_data=json_encode($arr1);
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS =>$login_data,
    CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json"
    ),
  ));
  $response = curl_exec($curl);
  curl_close($curl);
  $res=json_decode($response);
  $token = null;
  $token=$res->token;
  if($res->token){
    #cancel Order with order_id
    $curl = curl_init();
    $arr2=[
      "ids"=>[
        $order_id,
      ]
    ];
    $data=json_encode($arr2); 
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/cancel",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $data,
      CURLOPT_HTTPHEADER => array(
      "Content-Type: application/json",
      "Authorization: Bearer {$token}"
      ),
    ));

    $response = curl_exec($curl);
    $res=json_decode($response);
    curl_close($curl);
    return $res->message;
  }
}
#Cancel order with order_id
echo cancel_order(104026271);
?>

