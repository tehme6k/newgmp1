/between password hash check

                //Loop through each product for this BPR
                foreach($BprProducts as $bprProduct){
                    //Get that product
//                    $product = Product::findOrFail($bprProduct->id);
//                    //The amount used in this bpr for the product, grams
//                    $amountG= $bprProduct->amount;
//                    //If product has a Category of Powder, then divide by 1000 to convert the grams to Kilograms to match inv
//                    if($product->category_id == 1){
//                        $amountK = $amountG/1000;
//                    }
//                    //updated product total is current total minus the amount from the BPR, converted to kilograms if powder
//                    $total = $product->total - $amountK;
//
//
//                    //add entry to inventory table
//                    $product->inventories()->create([
//                        'product_id' => $product->id,
//                        'input_unit' => 'g',
//                        'input_amount' => $amountG,
//                        'use_amount' => $amountK,
//                        'vendor_id' => 0,
//                        'vendor_lot' => 0,
//                        'notes' => 'remove from inventory because batch issued',
//                        'status' => 'open',
//                        'expiration_date' => Carbon::now(),
//                        'type' => 'temp-deduction',
//                        'created_by' => $user_id
//
//                    ]);




                    //update product total
//                    $product->update([
//                        'total' => 999999999
//                    ]);
                }
//                dd('test');
//                //update status to issued
//                $bpr->update([
//                    'status' => 'issued',
//                    'approved_by' => $user_id
//                ]);

                //If everything is Successfull
                session()->flash('success', 'Batch Approved');

                return view('bprs.issued');