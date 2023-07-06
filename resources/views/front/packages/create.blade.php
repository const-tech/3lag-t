<section class="addPatient-section py-5">
    <div class="container">
        <h4 class="main-heading ">إضافة باكدج</h4>
    </div>
    <div class="container pt-0 p-3 bg-white vh-min-100 rounded-3 shadow">

        <div class="addPatient-content">
            

            <div class="form-group">
                <label for="">عنوان البرنامج</label>
                <input type="text" class="form-control" wire:model="title">
            </div>

            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th class="bg-light text-center" colspan="4">التمارين</th>
                    </tr>

                    <tr>
                        <th>#</th>
                        <th>التمارين</th>
                        <th>الوقت</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exercises as $index => $exercise)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <input type="text"
                                    class="form-control"wire:model="exercises.{{ $index }}.item">
                            </td>
                            <td>
                                <input type="time"
                                    class="form-control"wire:model="exercises.{{ $index }}.time">
                            </td>
                            <td>
                                @if (count($exercises) > 1)
                                    <button wire:click="removeExercise({{ $index }})"
                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">
                            <button wire:click="addExercise" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                أضف تمرين</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="form-group">
                <label for="">ملاحظات</label>
                <textarea class="form-control" wire:model="notes" rows="3"></textarea>
            </div>

            <table class="table table-bordered mt-3">

                <thead>
                    <tr>
                        <th class="bg-light text-center" colspan="3">نصائح اخصائي العلاج الطبيعي:</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>النصيحة</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($advices as $index => $advice)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <input type="text" class="form-control"wire:model="advices.{{ $index }}.item">
                            </td>

                            <td>
                                @if (count($advices) > 1)
                                    <button wire:click="removeAdvice({{ $index }})"
                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">
                            <button wire:click="addAdvice" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>
                                أضف نصيحة</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="w-100 d-flex align-items-center justify-content-center mt-2">
                <button wire:click="submit" class="send-data btn btn-primary">حفظ البيانات</button>
            </div>
        </div>
    </div>
</section>
