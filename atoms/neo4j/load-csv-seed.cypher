// mv atoms/neo4j/periodic-table.csv ~/.config/Neo4j-Desktop/Application/neo4jDatabases/database-UUID-goes-here/installation-version.number.here/import/

LOAD CSV WITH HEADERS 
FROM "file:///periodic-table.csv" 
AS line 
CREATE(:Element {
    AtomicNumber: toInteger(line.AtomicNumber),
    Element: line.Element,
    Symbol: line.Symbol,
    AtomicMass: toFloat(line.AtomicMass),
    NumberofNeutrons: toInteger(line.NumberofNeutrons),
    NumberofProtons: toInteger(line.NumberofProtons),
    NumberofElectrons: toInteger(line.NumberofElectrons),
    Period: toInteger(line.Period),
    Group: toInteger(line.Group),
    Phase: line.Phase,
    Radioactive: line.Radioactive,
    Natural: line.Natural,
    Metal: line.Metal,
    Nonmetal: line.Nonmetal,
    Metalloid: line.Metalloid,
    Type: line.Type,
    AtomicRadius: toFloat(line.AtomicRadius),
    Electronegativity: toFloat(line.Electronegativity),
    FirstIonization: toFloat(line.FirstIonization),
    Density: toFloat(line.Density),
    MeltingPoint: toFloat(line.MeltingPoint),
    BoilingPoint: toFloat(line.BoilingPoint),
    NumberOfIsotopes: toInteger(line.NumberOfIsotopes),
    Discoverer: line.Discoverer,
    Year: toInteger(line.Year),
    SpecificHeat: toFloat(line.SpecificHeat),
    NumberofShells: toInteger(line.NumberofShells),
    NumberofValence: toInteger(line.NumberofValence)
})