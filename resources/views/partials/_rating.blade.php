<script>
    @if($event)
        window.livewire.on('{{ $event }}', params => {
    @endif

    @if($event)
        var progressBarContainer = document.getElementById(params.slug);
    @else
        var progressBarContainer = document.getElementById('{{ $slug }}');
    @endif

    var bar = new ProgressBar.Circle(progressBarContainer, {
        color: '#fff',
        // This has to be the same size as the maximum width to
        // prevent clipping
        strokeWidth: 6,
        trailWidth: 3,
        trailColor: '#2C3143',
        easing: 'easeInOut',
        duration: 2500,
        text: {
            autoStyleContainer: false
        },
        from: {color: '#4060B6', width: 6},
        to: {color: '#4060B6', width: 6},
        // Set default step function for all animate calls
        step: function(state, circle){
            circle.path.setAttribute('stroke', state.color);
            circle.path.setAttribute('stroke-width', state.width);

            var value = Math.round(circle.value() * 100);
            // console.log('value', value);
            circle.setText(isNaN(value) ? 'NA' : value + '%');
        }
    });

    @if($event)
        console.log('event', params.rating);
            bar.animate(params.rating)
        });
    @else
        bar.animate({{ $rating / 100 }} );
    @endif
</script>
