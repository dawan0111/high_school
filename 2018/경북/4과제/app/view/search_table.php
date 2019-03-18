<?php foreach ($weight_list as $key => $weights): ?>
  <?php
    $rowspan = "rowspan='".(count($weights) - 2)."'";
  ?>
  <?php foreach ($weights as $k => $product): ?>
    <?php if (gettype($k) == "string") {
      continue;
    } ?>
    <tr>
      <?php if ($k === 0): ?>
        <td <?= $rowspan ?> class="w-1"><?php echo $key + 1 ?></td>
        <td <?= $rowspan ?>><?php echo $date ?></td>
      <?php endif ?>
      <td class="text-left">
        <p class="m-0">배송번호 : <?php echo $product["code"] ?></p>
        <p class="m-0">아이디 : <?php echo $product['user_id'] ?></p>
        <p class="m-0">회사명 : <?php echo $product['user_name'] ?></p>
        <p class="m-0">전화번호 : <?php echo $product['user_phone'] ?></p>
        <p class="m-0">배송중량 : <?php echo $product['weight'] ?>톤</p>
        <p class="m-0">신청일자 : <?php echo krDate($product["create_date"]) ?></p>
      </td>
      <td><?php echo $product['location'] ?></td>
      <?php if ($k === 0): ?>
        <td <?= $rowspan ?>><?php echo $nice_weight ?>톤</td>
        <td <?= $rowspan ?>><?php echo $weights["fast_spend"] ?>km</td>
        <td <?= $rowspan ?>>
          <?php foreach ($weights["fast_list"] as $fast_idx => $value): ?>
            <?php $location = join("-", $value); ?>
            <p>
              <label class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" name="way<?=$key?>" value="<?= $location ?>" <?= $fast_idx == 0 ? 'checked="checked"' : ""; ?>>
                <span class="custom-control-label"><?= $location ?></span>
              </label>
            </p>
          <?php endforeach ?>
        </td>
        <td <?= $rowspan ?>>
          <input type="hidden" name="order_date[]" value="<?php echo changeDate($date) ?>">
          <input type="hidden" name="product_idx[]" value="<?php echo join(",", array_column($weights, "idx")) ?>">
          <input type="hidden" name="weight[]" value="<?php echo $nice_weight ?>">
          <input type="hidden" name="spend[]" value="<?php echo $weights['fast_spend'] ?>">

          <button class="btn btn-primary btn-sm" name="point" value="<?=$key ?>">인수하기</button>
        </td>
      <?php endif ?>
    </tr>
  <?php endforeach ?>
<?php endforeach ?>