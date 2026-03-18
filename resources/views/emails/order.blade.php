<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>

<body style="margin:0; padding:0; background:#f4f6f8; font-family: Arial, Helvetica, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f8; padding:30px 0;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 3px 10px rgba(0,0,0,0.08);">

                    <!-- HEADER -->
                    <tr>
                        <td style="background:#4f46e5; color:#ffffff; padding:20px 30px; text-align:center;">
                            <h1 style="margin:0; font-size:24px;">Order Confirmation</h1>
                        </td>
                    </tr>

                    <!-- GREETING -->
                    <tr>
                        <td style="padding:30px; color:#333;">
                            <p style="font-size:16px; margin:0 0 10px;">
                                Hello <strong>{{ $order->user->name }}</strong>,
                            </p>

                            <p style="font-size:15px; color:#555;">
                                Thank you for your purchase! Your order
                                <strong>#{{ $order->order_number }}</strong> has been successfully placed.
                            </p>
                        </td>
                    </tr>

                    <!-- PRODUCT IMAGE -->
                    <tr>
                        <td align="center" style="padding:10px 30px;">
                            <img src="{{ asset('storage/' . $order->product->image) }}"
                                alt="{{ $order->product->name }}" style="max-width:500px; border-radius:6px;">
                        </td>
                    </tr>

                    <!-- ORDER TABLE -->
                    <tr>
                        <td style="padding:20px 30px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">

                                <thead>
                                    <tr style="background:#f1f5f9; text-align:left;">
                                        <th style="padding:12px; font-size:14px;">Product</th>
                                        <th style="padding:12px; font-size:14px;">Quantity</th>
                                        <th style="padding:12px; font-size:14px;">Price</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr style="border-bottom:1px solid #eee;">
                                        <td style="padding:12px; font-size:14px;">
                                            {{ $order->product->name }}
                                        </td>

                                        <td style="padding:12px; font-size:14px;">
                                            {{ $order->quantity }}
                                        </td>

                                        <td style="padding:12px; font-size:14px; font-weight:bold;">
                                            ${{ number_format($order->price_at_purchase, 2) }}
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </td>
                    </tr>

                    <!-- TOTAL SECTION -->
                    <tr>
                        <td style="padding:10px 30px 30px 30px; text-align:right;">
                            <p style="font-size:16px; margin:0;">
                                <strong>Total:
                                    ${{ number_format($order->price_at_purchase * $order->quantity, 2) }}</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td
                            style="background:#f9fafb; padding:20px 30px; text-align:center; font-size:13px; color:#888;">
                            <p style="margin:0;">If you have any questions, feel free to contact us.</p>
                            <p style="margin:5px 0 0;">© {{ date('Y') }} Your Company. All rights reserved.</p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
