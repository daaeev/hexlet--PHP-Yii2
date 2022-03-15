// Скрипт используется на главной странице index.php - SiteController::actionResume()
let url = location.pathname;

switch (true) {
    case url.includes('resume/all'):
        $('.resume-all').addClass('active');
        break;
    case url.includes('resume/new'):
        $('.resume-new').addClass('active');
        break;
    case url.includes('resume/popular'):
        $('.resume-popular').addClass('active');
        break;
    case url.includes('resume/norecomend'):
        $('.resume-norecomend').addClass('active');
        break;
    default:
        $('.resume-all').addClass('active');
        break;
}