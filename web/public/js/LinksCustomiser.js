// Скрипт используется на главной странице index.php - SiteController::actionResume()
let url = location.pathname;

switch (url) {
    case '/resume/all':
        $('.resume-all').addClass('active');
        break;
    case '/resume/new':
        $('.resume-new').addClass('active');
        break;
    case '/resume/popular':
        $('.resume-popular').addClass('active');
        break;
    case '/resume/norecomend':
        $('.resume-norecomend').addClass('active');
        break;
    default:
        $('.resume-all').addClass('active');
        break;
}