{{ $activity->user->name }} {{ $activity->subject->approved ? 'approved' : 'disapproved' }} a review titled "{{ $activity->subject->title }}"
