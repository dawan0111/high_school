
<div class="container-fluid p-3">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="/">홈</a>
    </li>
    <li class="breadcrumb-item active">관리자POS</li>
  </ol>

  <!-- content-start -->
  
  <style type="text/css">
    .tableCu{ width: auto; text-align: center; }
    .tableCu td{ border: #dfdfdf solid 1px; width: 60px; height: 60px; }
    .tdYellow { background: yellow; border: 0 !important}
    .last { border-right: yellow solid 1px !important; }
    .tdBlue { background: blue; border: 0 !important; color: #fff}
    .tdRed { background: red; }
  </style>
  <table class="tableCu mx-auto">
    <tr>
      <td class="tdYellow">

      </td>
      <?php foreach ($maps as $start => $way): ?>
        <td class="tdBlue">
           <?php echo $start ?>
        </td>
      <?php endforeach ?>
      <td class="tdBlue">
         <strong>도착지</strong>
         <p class="m-0">▲</p>
      </td>
    </tr>
    <?php foreach ($maps as $start => $ways): ?>
      <tr>
        <td class="tdYellow">
           <?php echo $start ?>
        </td>
        <?php foreach ($ways as $end => $spend): ?>
          <td <?php echo $spend == 0 ? 'class="tdRed"' : ""; ?>>
             <?php echo $spend ?>km 
          </td>
        <?php endforeach ?>
        <td class="tdBlue">
          
        </td>
      </tr>
    <?php endforeach ?>
    <tr>
      <td class="tdYellow">
         <strong>출발지</strong>
         <p class="m-0">▶</p>
      </td>
      <td class="tdYellow">
          
      </td>
      <td class="tdYellow">
         
      </td>
      <td class="tdYellow">
         
      </td>
      <td class="tdYellow">

      </td>
      <td class="tdYellow">
         
      </td>
      <td class="tdYellow">
         
      </td>
      <td class="tdYellow">
         
      </td>
      <td class="tdYellow">
        
      </td>
      <td class="tdYellow">
         
      </td>
      <td class="tdYellow last">
         
      </td>
      <td class="tdBlue">
        
      </td>
    </tr>


  </table>
  <!-- content-end -->

</div>