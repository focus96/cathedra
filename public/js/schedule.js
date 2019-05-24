$('#print').click(function() {


    const w = document.getElementById("example1").offsetWidth;
    const h = document.getElementById("example1").offsetHeight;
    html2canvas(document.getElementById("example1"), {
        onrendered: function(canvas) {
            var imgData = canvas.toDataURL('image/png',1);
            var doc = new jsPDF('p', 'mm',[w,h]);
            doc.addImage(imgData, 'PNG', 5, 5,w,h);
            doc.save('schedule.pdf');
        }
    });
});