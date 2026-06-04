<tr data-faq-id="{{ $faq->id }}" data-title-no="{{ $faq->title_no }}">
    <td>{{ $faq->title_no }}</td>
    <td>{{ $faq->question }}</td>
    <td>{!! html_entity_decode($faq->answer) !!}</td>
    <td>
        @if ($faq->status)
            <span class="badge bg-success">Active</span>
        @else
            <span class="badge bg-danger">Inactive</span>
        @endif
    </td>
    <td>
        @if ((int) $faq->zone === 1)
            <span class="badge bg-secondary">City/Country</span>
        @else
            <span class="badge bg-success">Main</span>
        @endif
    </td>
    <td>{{ datetimeFormatter($faq->created_at) }}</td>
    <td>
        <a href="javascript:void(0);" class="action-icon"
            onclick="courseFaqToggleStatus('{{ url(route('faq.status', ['id' => $faq->id, 'status' => $faq->status ? 0 : 1])) }}')">
            @if ($faq->status)
                <i class="ri-eye-off-fill" title="Inactive"></i>
            @else
                <i class="ri-eye-fill" title="Active"></i>
            @endif
        </a>

        <a href="javascript:void(0);" class="action-icon"
            onclick="courseFaqOpenEdit('{{ url(route('faq.edit', ['id' => $faq->id])) }}')">
            <i class="mdi mdi-square-edit-outline" title="Edit"></i>
        </a>

        <a href="javascript:void(0);" class="action-icon"
            onclick="courseFaqConfirmDelete('{{ url(route('faq.delete', $faq->id)) }}')">
            <i class="mdi mdi-delete" title="Delete"></i>
        </a>
    </td>
</tr>
