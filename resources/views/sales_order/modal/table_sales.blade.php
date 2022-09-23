<div class="row mt-2">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <label class="form-control-label" for="input-Selling">{{ __('Selling') }}</label>
        <div>
            <table id="selling" class="table-selling align-items-center table-flush">
                <thead class="thead-light">
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Curr</th>
                    <th>Price</th>
                    <th>Sub Total</th>
                    <th>Name</th>
                    <th>Remark</th>
                    <th>Action</th>
                </thead>
                <tbody class="selling">
                    @foreach ($data['selling_order'] as $x)
                        <tr class="row-selling">
                            <td><input class="form-control autosuggest ui-widget" type="text" id="description_s"
                                    name="description_s[]" value="{{ $x->description }}">
                            </td>
                            <td><input class="form-control qty" step="any" type="number" id="qty_s"
                                    name="qty_s[]" value="{{ $x->qty }}">
                            </td>
                            <td><select id="curr_s" name="curr_s[]" class="form-control form-select curr_s">
                                    <option value="{{ $x->curr }}" selected>{{ $x->curr }}</option>
                                    <option>IDR</option>
                                    <option>SGD</option>
                                    <option>USD</option>
                                    <option>EUR</option>
                                </select></td>
                            <td><input class="form-control price" type="text" id="price_s"
                                    value="{{ $x->price }}">
                                <input class="form-control price_real" type="text" id="price_s_r" name="price_s[]"
                                    value="{{ $x->price }}" hidden>
                            </td>
                            <td><input class="form-control sub_total_s" id="sub_total_s" value="{{ $x->sub_total }}"
                                    readonly>
                                <input class="form-control sub_total_s_real" type="text" id="sub_total_s_r"
                                    name="sub_total_s[]" value="{{ $x->sub_total }}" hidden>
                            </td>
                            <td><input type="text" id="name_s" class="form-control name_s ui-widget"
                                    name="name_s[]" value="{{ $x->name }}">
                            </td>
                            <td><input type="text" id="remark_s" class="form-control remark_s" name="remark_s[]"
                                    value="{{ $x->remark }}">
                            </td>
                            <td>
                                <a href="#" class="btn btn-primary btn-sm" id="addkolom_s"><i
                                        class="fa fa-plus"></i></a>
                                <a href="#" id="refreshkolom" class="btn btn-warning btn-sm refresh"><i
                                        class="fa fa-spinner"></i></a>
                                <a href="#" id="removekolom_s" class="btn btn-danger btn-sm remove_s"><i
                                        class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <label class="form-control-label" for="input-Buying">{{ __('Buying') }}</label>
        <div class="table-responsive">
            <table id="buying" class="table-buying align-items-center table-flush">
                <thead class="thead-light">
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Curr</th>
                    <th>Price</th>
                    <th>Sub Total</th>
                    <th>Name</th>
                    <th>Remark</th>
                    <th>Action</th>
                </thead>
                <tbody class="buying">
                    @foreach ($data['buying_order'] as $x)
                        <tr class="row-buying">
                            <td><input type="text" class="form-control autosuggest ui-widget" id="description_b"
                                    name="description_b[]" value="{{ $x->description }}">
                            </td>
                            <td><input step="any" class="form-control qty" type="text" id="qty_b"
                                    name="qty_b[]" value="{{ $x->qty }}">
                            </td>
                            {{-- <td><input type="text" id="curr_b" name="curr_b[]"></td> --}}
                            <td><select id="curr_b" name="curr_b[]" class="form-control form-select curr_b">
                                    <option value="{{ $x->curr }}" selected>{{ $x->curr }}</option>
                                    <option>IDR</option>
                                    <option>SGD</option>
                                    <option>USD</option>
                                    <option>EUR</option>
                                </select></td>
                            <td><input type="text" class="form-control price" id="price_b"
                                    value="{{ $x->price }}">
                                <input type="text" class="form-control price_real" id="price_b_r" name="price_b[]"
                                    value="{{ $x->price }}" hidden>
                            </td>
                            <td><input type="text" class="form-control sub_total_b" id="sub_total_b"
                                    value="{{ $x->sub_total }}" readonly>
                                <input type="text" class="form-control sub_total_b_real" id="sub_total_b_real"
                                    name="sub_total_b[]" value="{{ $x->sub_total }}" hidden>
                            </td>
                            <td><input type="text" class="form-control name_b ui-widget" id="name_b"
                                    name="name_b[]" value="{{ $x->name }}"></td>
                            <td><input type="text" class="form-control remark_b" id="remark_b" name="remark_b[]"
                                    value="{{ $x->remark }}">
                            </td>
                            <td>
                                <a href="#" class="btn btn-primary btn-sm" id="addkolom_b"><i
                                        class="fa fa-plus"></i></a>
                                <a href="#" id="refreshkolom" class="btn btn-warning btn-sm refresh"><i
                                        class="fa fa-spinner"></i></a>
                                <a href="#" id="removekolom_b" class="btn btn-danger btn-sm remove_b"><i
                                        class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <label class="form-control-label" for="input-Profit">{{ __('Down Payment') }}</label>
        <div>
            <table id="dp" class="table-dp align-items-center table-flush">
                <thead class="thead-light">
                    <th>Customer</th>
                    <th>Curr</th>
                    <th>Total</th>
                    <th>DP</th>
                </thead>
                <tbody>
                    <tr>
                        <td><input class="form-control" type="text" id="customer_dp" name="customer_dp"
                                value="{{ $data['dp']->customer }}" readonly required></td>
                        <td><input class="form-control" type="text" id="currency_dp" name="currency_dp"
                                value="{{ $data['dp']->currency }}" readonly required></td>
                        <td><input class="form-control" id="total_dp" name="total_dp"
                                value="{{ $data['dp']->total }}" readonly required></td>
                        <td><input class="form-control" id="d_payment" name="dp" value="{{ $data['dp']->dp }}"
                                required></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <label class="form-control-label" for="input-Profit">{{ __('Profit') }}</label>
        <div class="table-responsive">
            <table id="profit" class="table-profit align-items-center table-flush">
                <thead class="thead-light">
                    <th>Curr</th>
                    <th>Total Selling</th>
                    <th>Total Buying</th>
                    <th>Profit</th>
                </thead>
                <tbody class="profit_tb">
                    {{-- <tr>
                     <td><input type="text" class="curr_prof" id="currency_prof" name="currency[]"
                             readonly></td>
                     <td><input type="text" id="total_selling" name="total_selling[]" readonly>
                     </td>
                     <td><input type="text" id="total_buying" name="total_buying[]" readonly>
                     </td>
                     <td><input type="text" id="profit_buy" name="profit[]" readonly>
                     </td>
                 </tr> --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
