// 1. Ampidiro ny URL sy ny Key-nao
const supabaseUrl = 'https://ziuwvkxxkrfjeoeszplk.supabase.co'
const supabaseKey = 'sb_publishable_QbTR1RVxIXcv9kQjWWE-Xw_QSVXz8R-'

// 2. Amorony "client" ny Supabase
const supabase = supabase.createClient(supabaseUrl, supabaseKey)

// 3. Ohatra fakana data avy amin'ny table "vokatra"
async function fafaoData() {
  const { data, error } = await supabase
    .from('vokatra') // Anaran'ny table-nao
    .select('*')     // Inona no halaina (eto dia izy rehetra)

  if (error) {
    console.error('Misy fahadisoana:', error)
  } else {
    console.log('Ireto ny data:', data)
  }
}

fafaoData();