@forelse ($faqs as $faq)
    @include('backend.pages.course.section.faq._row', ['faq' => $faq])
@empty
    <tr class="js-faq-empty-row">
        <td colspan="7" class="text-center">No FAQs found.</td>
    </tr>
@endforelse
