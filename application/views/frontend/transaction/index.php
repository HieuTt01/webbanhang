<style>
table#cart_contents td {
    padding: 10px;
    border: 1px solid #ccc
}
</style>
<div class="box-center">
    <!-- The box-center product-->

    <div class="tittle-box-center">
        <h2>Thông tin mua hàng(<?php echo $total_row?> giao dịch)</h2>
    </div>
    <div class="box-content-center product">
        <!-- The box-content-center -->
        <?php if($total_row > 0):?>
        <table id="cart_contents" cellpadding="0" cellspacing="0" width="95%" class="sTable mTable myTable withCheck" ">
                        <thead>
                             <td style=" color:blue">Stt</td>
            <td style="color:blue">Mã giao dịch</td>
            <td style="color:blue">Số tiền</td>
            <td style="color:blue">Hình thức thanh toán</td>
            <td style="color:blue">Trạng thái</td>
            <td style="color:blue">Ngày tạo</td>
            <td style="color:blue">...</td>

            </thead>
            <tbody>
                <?php  $i=1;?>
                <?php foreach($list as $row):?>
                <tr>
                    <td style=><?php echo $i?></td>
                    <td style=><?php echo $row->id?></td>
                    <td style="color:red"><?php echo number_format($row->amount);?>đ</td>
                    <td style=><?php echo $row->payment?></td>
                    <td class="textC"><?php
					                if($row->status==0) echo 'Chưa thanh toán';
					                elseif($row->status==1)echo 'Đã thanh toán';
					                else echo 'Giao dịch đã hủy';
					               ?></td>
                    <td style=><?php echo $row->created?></td>
                    <td class="option textC">
                        <a href="<?php echo base_url('transaction/view/'.$row->id)?>" target="_blank" class="tipS"
                            title="Xem chi tiết đơn hàng">
                            <img src="<?php echo public_url('admin/images')?>/icons/color/view.png">
                        </a>
                    </td>
                </tr>
                <?php  $i =$i +1;?>
                <?php endforeach;?>

            </tbody>
        </table>
        <?php else:?>
        <h4 style="color:red">Không có giao dịch nào trước đó!!!</h4>
        <?php endif;?>
    </div>
</div>